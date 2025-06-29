<?php

namespace E2E\Core;

use Civi\Core\AssetBuilder;
use Civi\Core\Event\GenericHookEvent;
use Civi\Test\HttpTestTrait;

/**
 * Class AssetBuilderTest
 * @package E2E\Core
 * @group e2e
 */
class AssetBuilderTest extends \CiviEndToEndTestCase {

  use HttpTestTrait;

  protected $fired;

  /**
   * @inheritDoc
   */
  protected function setUp(): void {
    parent::setUp();

    \Civi::service('asset_builder')->clear();

    $this->fired['hook_civicrm_buildAsset'] = 0;
    \Civi::dispatcher()->addListener('hook_civicrm_buildAsset', [$this, 'counter']);
    \Civi::dispatcher()->addListener('hook_civicrm_buildAsset', [$this, 'buildSquareTxt']);
    \Civi::dispatcher()->addListener('hook_civicrm_buildAsset', [$this, 'buildSquareJs']);
  }

  protected function tearDown(): void {
    \Civi::dispatcher()->removeListener('hook_civicrm_buildAsset', [$this, 'counter']);
    \Civi::dispatcher()->removeListener('hook_civicrm_buildAsset', [$this, 'buildSquareTxt']);
    \Civi::dispatcher()->removeListener('hook_civicrm_buildAsset', [$this, 'buildSquareJs']);
    parent::tearDown();
  }

  /**
   * @param \Civi\Core\Event\GenericHookEvent $e
   * @see \CRM_Utils_Hook::buildAsset()
   */
  public function counter(GenericHookEvent $e) {
    $this->fired['hook_civicrm_buildAsset']++;
  }

  /**
   * @param \Civi\Core\Event\GenericHookEvent $e
   * @see \CRM_Utils_Hook::buildAsset()
   */
  public function buildSquareTxt(GenericHookEvent $e) {
    if ($e->asset !== 'square.txt') {
      return;
    }
    $this->assertTrue(in_array($e->params['x'], [11, 12]));

    $e->mimeType = 'text/plain';
    $e->content = "Square: " . ($e->params['x'] * $e->params['x']);
  }

  /**
   * @param \Civi\Core\Event\GenericHookEvent $e
   * @see \CRM_Utils_Hook::buildAsset()
   */
  public function buildSquareJs(GenericHookEvent $e) {
    if ($e->asset !== 'square.js') {
      return;
    }
    $this->assertTrue(in_array($e->params['x'], [11, 12]));

    $e->mimeType = 'application/javascript';
    $e->content = "var square=" . ($e->params['x'] * $e->params['x']) . ';';
  }

  /**
   * Get a list of example assets to build/request.
   * @return array
   */
  public static function getExamples() {
    $examples = [];

    $examples[] = [
      0 => 'square.txt',
      1 => ['x' => 11],
      2 => 'text/plain',
      3 => 'Square: 121',
    ];
    $examples[] = [
      0 => 'square.txt',
      1 => ['x' => 12],
      2 => 'text/plain',
      3 => 'Square: 144',
    ];
    $examples[] = [
      0 => 'square.js',
      1 => ['x' => 12],
      2 => 'application/javascript',
      3 => 'var square=144;',
    ];

    return $examples;
  }

  /**
   * @param string $asset
   *   Ex: 'square.txt'.
   * @param array $params
   *   Ex: [x=>12].
   * @param string $expectedMimeType
   *   Ex: 'text/plain'.
   * @param string $expectedContent
   *   Ex: 'Square: 144'.
   * @dataProvider getExamples
   */
  public function testRender($asset, $params, $expectedMimeType, $expectedContent) {
    $asset = \Civi::service('asset_builder')->render($asset, $params);
    $this->assertEquals(1, $this->fired['hook_civicrm_buildAsset']);
    $this->assertEquals($expectedMimeType, $asset['mimeType']);
    $this->assertEquals($expectedContent, $asset['content']);
  }

  /**
   * @param string $asset
   *   Ex: 'square.txt'.
   * @param array $params
   *   Ex: [x=>12].
   * @param string $expectedMimeType
   *   Ex: 'text/plain'.
   * @param string $expectedContent
   *   Ex: 'Square: 144'.
   * @dataProvider getExamples
   */
  public function testGetUrl_cached($asset, $params, $expectedMimeType, $expectedContent) {
    \Civi::service('asset_builder')->setCacheEnabled(TRUE);
    $url = \Civi::service('asset_builder')->getUrl($asset, $params);
    $this->assertEquals(1, $this->fired['hook_civicrm_buildAsset']);
    $this->assertMatchesRegularExpression(';^https?:.*dyn/square.[0-9a-f]+.(txt|js)$;', $url);
    $response = $this->createGuzzle()->get($url);
    // Note: This actually relies on httpd to determine MIME type.
    // That could be ambiguous for javascript.
    $this->assertContentType($expectedMimeType, $response);
    $this->assertStatusCode(200, $response);
  }

  /**
   * @param string $asset
   *   Ex: 'square.txt'.
   * @param array $params
   *   Ex: [x=>12].
   * @param string $expectedMimeType
   *   Ex: 'text/plain'.
   * @param string $expectedContent
   *   Ex: 'Square: 144'.
   * @dataProvider getExamples
   */
  public function testGetUrl_uncached($asset, $params, $expectedMimeType, $expectedContent) {
    \Civi::service('asset_builder')->setCacheEnabled(FALSE);
    $url = \Civi::service('asset_builder')->getUrl($asset, $params);
    $this->assertEquals(0, $this->fired['hook_civicrm_buildAsset']);
    // Ex: Traditional URLs on D7 have "/". Traditional URLs on WP have "%2F".
    $this->assertMatchesRegularExpression(';^https?:.*civicrm(/|%2F)asset(/|%2F)builder.*square.(txt|js);', $url);

    // Simulate a request. Our fake hook won't fire in a real request.
    parse_str(parse_url($url, PHP_URL_QUERY), $get);
    $asset = AssetBuilder::pageRender($get);
    $this->assertEquals($expectedMimeType, $asset['mimeType']);
    $this->assertEquals($expectedContent, $asset['content']);
  }

  /**
   * @group ornery
   *
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function testInvalid(): void {
    \Civi::service('asset_builder')->setCacheEnabled(FALSE);
    $url = \Civi::service('asset_builder')->getUrl('invalid.json');
    try {
      $guzzleClient = new \GuzzleHttp\Client();
      $guzzleResponse = $guzzleClient->request('GET', $url, ['timeout' => 2]);
      $this->fail('Expecting ClientException... but it was not thrown!');
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $this->assertNotEmpty(preg_match(';404;', $e->getMessage()),
        'Expect to find HTTP 404. Found: ' . json_encode(preg_match(';^HTTP;', $e->getMessage())));
      $this->assertEquals('Unrecognized asset name: invalid.json', $e->getResponse()->getBody());
    }
  }

}
