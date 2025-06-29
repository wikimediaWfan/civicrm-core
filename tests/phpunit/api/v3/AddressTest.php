<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 *  Test APIv3 civicrm_activity_* functions
 *
 * @package CiviCRM_APIv3
 * @subpackage API_Contact
 */

/**
 * Class api_v3_AddressTest
 * @group headless
 */
class api_v3_AddressTest extends CiviUnitTestCase {
  protected $_contactID;
  protected $_locationTypeID;
  protected $_params;

  protected $_entity;

  public function setUp(): void {
    $this->_entity = 'Address';
    parent::setUp();

    $this->_contactID = $this->organizationCreate();
    $this->_locationTypeID = $this->locationTypeCreate();
    CRM_Core_PseudoConstant::flush();

    $this->_params = [
      'contact_id' => $this->_contactID,
      'location_type_id' => $this->_locationTypeID,
      'street_name' => 'Ambachtstraat',
      'street_number' => '23',
      'street_address' => 'Ambachtstraat 23',
      'postal_code' => '6971 BN',
      'country_id' => '1152',
      'city' => 'Brummen',
      'is_primary' => 1,
    ];
  }

  public function tearDown(): void {
    $this->locationTypeDelete($this->_locationTypeID);
    $this->contactDelete($this->_contactID);
    $this->quickCleanup(['civicrm_address', 'civicrm_relationship']);
    $this->callAPISuccess('Setting', 'create', ['geoProvider' => NULL]);
    parent::tearDown();
  }

  /**
   * @param int $version
   *
   * @dataProvider versionThreeAndFour
   * @throws \CRM_Core_Exception
   */
  public function testCreateAddress($version) {
    $this->_apiversion = $version;
    $result = $this->callAPISuccess('Address', 'create', $this->_params);
    $this->assertEquals(1, $result['count']);
    $this->assertNotNull($result['values'][$result['id']]['id']);
    $this->getAndCheck($this->_params, $result['id'], 'address');
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressParsing($version) {
    $this->_apiversion = $version;
    $params = [
      'street_parsing' => 1,
      'street_address' => '54A Excelsior Ave. Apt 1C',
      'location_type_id' => $this->_locationTypeID,
      'contact_id' => $this->_contactID,
    ];
    $result = $this->callAPISuccess('address', 'create', $params);
    $this->assertEquals(54, $result['values'][$result['id']]['street_number']);
    $this->assertEquals('A', $result['values'][$result['id']]['street_number_suffix']);
    $this->assertEquals('Excelsior Ave.', $result['values'][$result['id']]['street_name']);
    $this->assertEquals('Apt 1C', $result['values'][$result['id']]['street_unit']);
    $this->callAPISuccess('address', 'delete', ['id' => $result['id']]);

  }

  /**
   * Is_primary should be set as a default.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressTestDefaults($version) {
    $this->_apiversion = $version;
    $params = $this->_params;
    unset($params['is_primary']);
    $result = $this->callAPISuccess('address', 'create', $params);
    $this->assertEquals(1, $result['count']);
    $this->assertEquals(1, $result['values'][$result['id']]['is_primary']);
    $this->getAndCheck($this->_params, $result['id'], 'address');
  }

  /**
   * If no location is specified when creating a new address, it should default to
   * the LocationType default
   *
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressDefaultLocation($version) {
    $this->_apiversion = $version;
    $params = $this->_params;
    unset($params['location_type_id']);
    $result = $this->callAPISuccess($this->_entity, 'create', $params);
    $this->assertEquals(CRM_Core_BAO_LocationType::getDefault()->id, $result['values'][$result['id']]['location_type_id']);
    $this->callAPISuccess($this->_entity, 'delete', ['id' => $result['id']]);
  }

  /**
   * FIXME: Api4
   */
  public function testCreateAddressTooLongSuffix(): void {
    $params = $this->_params;
    $params['street_number_suffix'] = 'really long string';
    $this->callAPIFailure('address', 'create', $params);
  }

  /**
   * Create an address with a master ID and ensure that a relationship is created.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressWithMasterRelationshipHousehold($version) {
    $this->_apiversion = $version;
    $householdID = $this->householdCreate();
    $address = $this->callAPISuccess('address', 'create', array_merge($this->_params, $this->_params, ['contact_id' => $householdID]));
    $individualID = $this->individualCreate();
    $individualParams = [
      'contact_id' => $individualID,
      'master_id' => $address['id'],
    ];
    $this->callAPISuccess('address', 'create', array_merge($this->_params, $individualParams));
    $this->callAPISuccess('relationship', 'getcount', [
      'contact_id_a' => $individualID,
      'contact_id_b' => $this->_contactID,
    ]);
  }

  /**
   * Create an address with a master ID and ensure that a relationship is created.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressWithMasterRelationshipOrganization($version) {
    $this->_apiversion = $version;
    $address = $this->callAPISuccess('address', 'create', $this->_params);
    $individualID = $this->individualCreate();
    $individualParams = [
      'contact_id' => $individualID,
      'master_id' => $address['id'],
    ];
    $this->callAPISuccess('address', 'create', array_merge($this->_params, $individualParams));
    $this->callAPISuccess('relationship', 'getcount', [
      'contact_id_a' => $individualID,
      'contact_id_b' => $this->_contactID,
    ], 1);
  }

  /**
   * Create an address with a master ID and relationship creation disabled.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressWithoutMasterRelationshipOrganization($version) {
    $this->_apiversion = $version;
    $address = $this->callAPISuccess('address', 'create', $this->_params);
    $individualID = $this->individualCreate();
    $individualParams = [
      'contact_id' => $individualID,
      'master_id' => $address['id'],
      'add_relationship' => 0,
    ];
    $this->callAPISuccess('address', 'create', array_merge($this->_params, $individualParams));
    $this->callAPISuccess('relationship', 'getcount', [
      'contact_id_a' => $individualID,
      'contact_id_b' => $this->_contactID,
    ], 0);
  }

  /**
   * Create an address with a master ID and ensure that a relationship is created.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressWithMasterRelationshipChangingOrganization($version) {
    $this->_apiversion = $version;
    $address = $this->callAPISuccess('address', 'create', $this->_params);
    $organisation2ID = $this->organizationCreate();
    $address2 = $this->callAPISuccess('address', 'create', array_merge($this->_params, ['contact_id' => $organisation2ID]));
    $individualID = $this->individualCreate();
    $individualParams = array_merge($this->_params, [
      'contact_id' => $individualID,
      'master_id' => $address['id'],
    ]);
    $individualAddress = $this->callAPISuccess('address', 'create', $individualParams);
    $individualParams['master_id'] = $address2['id'];
    $individualParams['id'] = $individualAddress['id'];
    $this->callAPISuccess('address', 'create', $individualParams);
    $this->callAPISuccessGetCount('relationship', ['contact_id_a' => $individualID], 2);
    $this->markTestIncomplete('Remainder of test checks that employer relationship is disabled when new one is created but turns out to be not happening - by design?');
    $this->callAPISuccessGetCount('relationship', ['contact_id_a' => $individualID, 'is_active' => FALSE], 1);
    $this->callAPISuccessGetCount('relationship', [
      'contact_id_a' => $individualID,
      'is_active' => TRUE,
      'contact_id_b' => $organisation2ID,
    ], 1);

  }

  /**
   * Is_primary should be set as a default.
   *
   * ie. create the address, unset the params & recreate.
   * is_primary should be 0 before & after the update. ie - having no other
   * address is_primary is invalid.
   *
   * @param int $version
   *
   * @dataProvider versionThreeAndFour
   * @throws \CRM_Core_Exception
   */
  public function testCreateAddressTestDefaultWithID(int $version): void {
    $this->_apiversion = $version;
    $params = $this->_params;
    $params['is_primary'] = 0;
    $result = $this->callAPISuccess('Address', 'create', $params);
    unset($params['is_primary']);
    $params['id'] = $result['id'];
    $this->callAPISuccess('Address', 'create', $params);
    $result = $this->callAPISuccess('Address', 'get', ['contact_id' => $params['contact_id'], 'return' => 'is_primary']);
    $this->assertEquals(1, $result['count']);
    $this->assertEquals(1, $result['values'][$result['id']]['is_primary']);
    $this->getAndCheck($params, $result['id'], 'address');
  }

  /**
   * test address deletion.
   *
   * @param int $version
   *
   * @dataProvider versionThreeAndFour
   * @throws \CRM_Core_Exception
   */
  public function testDeleteAddress($version): void {
    $this->_apiversion = $version;
    //check there are no address to start with
    $get = $this->callAPISuccess('address', 'get', [
      'location_type_id' => $this->_locationTypeID,
    ]);
    $this->assertEquals(0, $get['count'], 'Contact already exists ');

    //create one
    $create = $this->callAPISuccess('address', 'create', $this->_params);

    $result = $this->callAPISuccess('address', 'delete', ['id' => $create['id']]);
    $this->assertEquals(1, $result['count']);
    $get = $this->callAPISuccess('address', 'get', [
      'location_type_id' => $this->_locationTypeID,
    ]);
    $this->assertEquals(0, $get['count'], 'Contact not successfully deleted In line ' . __LINE__);
  }

  /**
   * Test civicrm_address_get - success expected.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetAddress($version) {
    $this->_apiversion = $version;
    $address = $this->callAPISuccess('address', 'create', $this->_params);

    $params = [
      'contact_id' => $this->_contactID,
      'street_name' => $address['values'][$address['id']]['street_name'],
      'return' => ['location_type_id', 'is_primary', 'street_address'],
    ];
    $result = $this->callAPISuccess('Address', 'Get', $params);
    $this->assertEquals($address['values'][$address['id']]['location_type_id'], $result['values'][$address['id']]['location_type_id']);
    $this->assertEquals($address['values'][$address['id']]['is_primary'], $result['values'][$address['id']]['is_primary']);
    $this->assertEquals($address['values'][$address['id']]['street_address'], $result['values'][$address['id']]['street_address']);
  }

  /**
   * Test civicrm_address_get - success expected.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetSingleAddress($version) {
    $this->_apiversion = $version;
    $this->callAPISuccess('address', 'create', $this->_params);
    $params = [
      'contact_id' => $this->_contactID,
      'return' => 'location_type_id',
    ];
    $address = $this->callAPISuccessGetSingle('Address', ($params));
    $this->assertEquals($address['location_type_id'], $this->_params['location_type_id']);
  }

  /**
   * Test civicrm_address_get with sort option- success expected.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetAddressSort($version) {
    $this->_apiversion = $version;
    $create = $this->callAPISuccess('address', 'create', $this->_params);
    $this->callAPISuccess('address', 'create', array_merge($this->_params, ['street_address' => 'yzy']));
    $params = [
      'options' => [
        'sort' => 'street_address DESC',
        'limit' => 2,
      ],
      'sequential' => 1,
      'return' => 'street_address',
    ];
    $result = $this->callAPISuccess('Address', 'Get', $params);
    $this->assertEquals(2, $result['count']);
    $this->assertEquals('Ambachtstraat 23', $result['values'][1]['street_address']);
  }

  /**
   * Test civicrm_address_get with sort option- success expected.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetAddressLikeSuccess($version) {
    $this->_apiversion = $version;
    $this->callAPISuccess('address', 'create', $this->_params);
    $params = [
      'street_address' => ['LIKE' => '%mb%'],
      'sequential' => 1,
      'return' => 'street_address',
    ];
    $result = $this->callAPISuccess('Address', 'Get', $params);
    $this->assertEquals(1, $result['count']);
    $this->assertEquals('Ambachtstraat 23', $result['values'][0]['street_address']);
  }

  /**
   * Test civicrm_address_get with sort option- success expected.
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetAddressLikeFail($version) {
    $this->_apiversion = $version;
    $this->callAPISuccess('address', 'create', $this->_params);
    $params = [
      'street_address' => ['LIKE' => "'%xy%'"],
      'sequential' => 1,
    ];
    $result = $this->callAPISuccessGetCount('Address', $params, 0);
    $this->assertEquals(0, $result);
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testGetWithCustom($version) {
    $this->_apiversion = $version;
    $ids = $this->entityCustomGroupWithSingleFieldCreate(__FUNCTION__, __FILE__);

    $params = $this->_params;
    $params['custom_' . $ids['custom_field_id']] = "custom string";

    $result = $this->callAPISuccess($this->_entity, 'create', $params);

    $getParams = ['id' => $result['id'], 'return' => ['custom']];
    $check = $this->callAPISuccess($this->_entity, 'get', $getParams);

    $this->assertEquals("custom string", $check['values'][$check['id']]['custom_' . $ids['custom_field_id']], ' in line ' . __LINE__);

    $this->customFieldDelete($ids['custom_field_id']);
    $this->customGroupDelete($ids['custom_group_id']);
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressPrimaryHandlingChangeToPrimary($version) {
    $this->_apiversion = $version;
    $params = $this->_params;
    unset($params['is_primary']);
    $address1 = $this->callAPISuccess('address', 'create', $params);
    $this->assertApiSuccess($address1);
    //now we check & make sure it has been set to primary
    $check = $this->callAPISuccess('address', 'getcount', [
      'is_primary' => 1,
      'id' => $address1['id'],
    ]);
    $this->assertEquals(1, $check);
    $this->callAPISuccess('address', 'delete', ['id' => $address1['id']]);
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testCreateAddressPrimaryHandlingChangeExisting($version) {
    $this->_apiversion = $version;
    $address1 = $this->callAPISuccess('address', 'create', $this->_params);
    $this->callAPISuccess('address', 'create', $this->_params);
    $check = $this->callAPISuccess('address', 'getcount', [
      'is_primary' => 1,
      'contact_id' => $this->_contactID,
    ]);
    $this->assertEquals(1, $check);
    $this->callAPISuccess('address', 'delete', ['id' => $address1['id']]);
  }

  /**
   * Test Creating address of same type alreay ind the database
   * This is legacy API v3 behaviour and not correct behaviour
   * however we are too far down the path wiwth v3 to fix this
   * @link https://chat.civicrm.org/civicrm/pl/zcq3jkg69jdt5g4aqze6bbe9pc
   * FIXME: Api4
   */
  public function testCreateDuplicateLocationTypes(): void {
    $address1 = $this->callAPISuccess('address', 'create', $this->_params);
    $address2 = $this->callAPISuccess('address', 'create', [
      'location_type_id' => $this->_locationTypeID,
      'street_address' => '1600 Pensilvania Avenue',
      'city' => 'Washington DC',
      'is_primary' => 0,
      'is_billing' => 0,
      'contact_id' => $this->_contactID,
    ]);
    $check = $this->callAPISuccess('address', 'getcount', [
      'contact_id' => $this->_contactID,
      'location_type_id' => $this->_locationTypeID,
    ]);
    $this->assertEquals(2, $check);
    $this->callAPISuccess('address', 'delete', ['id' => $address1['id']]);
    $this->callAPISuccess('address', 'delete', ['id' => $address2['id']]);
  }

  public function testGetWithJoin(): void {
    $cid = $this->individualCreate([
      'api.Address.create' => [
        'street_address' => __FUNCTION__,
        'location_type_id' => $this->_locationTypeID,
      ],
    ]);
    $result = $this->callAPISuccess('address', 'getsingle', [
      'check_permissions' => TRUE,
      'contact_id' => $cid,
      'street_address' => __FUNCTION__,
      'return' => 'contact_id.contact_type',
    ]);
    $this->assertEquals('Individual', $result['contact_id.contact_type']);
  }

  /**
   * Test Address create with a state name that at least two countries have, e.g. Maryland, United States vs. Maryland, Liberia
   *
   * @see https://lab.civicrm.org/dev/core/issues/725
   */
  public function testCreateAddressStateProvinceIDCorrectForCountry(): void {
    $params = $this->_params;
    $params['sequential'] = 1;
    // United States country id
    $params['country_id'] = '1228';
    $params['state_province_id'] = 'Maryland';
    $params['city'] = 'Baltimore';
    $params['street_address'] = '600 N Charles St.';
    $params['postal_code'] = '21201';
    unset($params['street_name']);
    unset($params['street_number']);
    $address1 = $this->callAPISuccess('address', 'create', $params);
    // should find state_province_id of 1019, Maryland, United States ... NOT 3497, Maryland, Liberia
    $this->assertEquals('1019', $address1['values'][0]['state_province_id']);

    // Now try it in Liberia
    $params = $this->_params;
    $params['sequential'] = 1;
    $params['country_id'] = \Civi\Api4\Country::get()
      ->addWhere('name', '=', 'Liberia')
      ->execute()
      ->single()['id'];
    $params['state_province_id'] = 'Maryland';
    $address2 = $this->callAPISuccess('address', 'create', $params);
    $liberia_maryland_id = \Civi\Api4\StateProvince::get()
      ->addWhere('country_id', '=', $params['country_id'])
      ->addWhere('name', '=', 'Maryland')
      ->execute()
      ->single()['id'];
    $this->assertEquals($liberia_maryland_id, $address2['values'][0]['state_province_id']);
  }

  public static function getSymbolicCountryStateExamples() {
    return [
      // [mixed $inputCountry, mixed $inputState, int $expectCountry, int $expectState]
      [1228, 1004, 1228, 1004],
      //['US', 'CA', 1228, 1004],
      //['US', 'TX', 1228, 1042],
      ['US', 'California', 1228, 1004],
      [1228, 'Texas', 1228, 1042],
      // Don't think these have been supported?
      // ['United States', 1004, 1228, 1004] ,
      // ['United States', 'TX', 1228, 1042],
    ];
  }

  /**
   * @param mixed $inputCountry
   *   Ex: 1228 or 'US'
   * @param mixed $inputState
   *   Ex: 1004 or 'CA'
   * @param int $expectCountry
   * @param int $expectState
   * @dataProvider getSymbolicCountryStateExamples
   */
  public function testCreateAddressSymbolicCountryAndState($inputCountry, $inputState, $expectCountry, $expectState) {
    $cid = $this->individualCreate();
    $r = $this->callAPISuccess('Address', 'create', [
      'contact_id' => $cid,
      'location_type_id' => 1,
      'street_address' => '123 Some St',
      'city' => 'Hereville',
      //'US',
      'country_id' => $inputCountry,
      // 'California',
      'state_province_id' => $inputState,
      'postal_code' => '94100',
    ]);
    $created = CRM_Utils_Array::first($r['values']);
    $this->assertEquals($expectCountry, $created['country_id']);
    $this->assertEquals($expectState, $created['state_province_id']);
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testBuildStateProvinceOptionsWithDodgyProvinceLimit($version) {
    $this->_apiversion = $version;
    $provinceLimit = [1228, "abcd;ef"];
    $this->callAPISuccess('setting', 'create', [
      'provinceLimit' => $provinceLimit,
    ]);
    $result = $this->callAPIFailure('address', 'getoptions', ['field' => 'state_province_id']);
    // confirm that we hit our error not a SQLI.
    $this->assertEquals('Failed encoding non-numeric value (#countryLimit)', $result['error_message']);
    $this->callAPISuccess('setting', 'create', [
      'provinceLimit' => [1228],
    ]);
    // Now confirm with a correct province setting it works fine
    $options = $this->callAPISuccess('address', 'getoptions', ['field' => 'state_province_id']);
    $this->assertLessThan(70, count($options['values']));
  }

  /**
   * @param int $version
   * @dataProvider versionThreeAndFour
   */
  public function testBuildCountryWithDodgyCountryLimitSetting($version) {
    $this->_apiversion = $version;
    $countryLimit = [1228, "abcd;ef"];
    $this->callAPISuccess('setting', 'create', [
      'countryLimit' => $countryLimit,
    ]);
    $result = $this->callAPIFailure('address', 'getoptions', ['field' => 'country_id']);
    // confirm that we hit our error not a SQLI.
    $this->assertEquals('Failed encoding non-numeric value (#countryLimit)', $result['error_message']);
    $this->callAPISuccess('setting', 'create', [
      'countryLimit' => [1228],
    ]);
    // Now confirm with a correct province setting it works fine
    $options = $this->callAPISuccess('address', 'getoptions', ['field' => 'country_id']);
    $this->assertCount(1, $options['values']);
  }

  public function testBuildCountyWithDodgeStateProvinceFiltering(): void {
    $result = $this->callAPIFailure('Address', 'getoptions', [
      'field' => 'county_id',
      'state_province_id' => "abcd;ef",
    ]);
    $this->assertEquals('Failed encoding non-numeric value (#stateProvince)', $result['error_message']);
    $goodResult = $this->callAPISuccess('Address', 'getoptions', [
      'field' => 'county_id',
      'state_province_id' => 1004,
    ]);
    $this->assertEquals('San Francisco', $goodResult['values'][4]);
  }

  public function testGetOptionsAbbr(): void {
    $result = $this->callAPISuccess('Address', 'getoptions', [
      'field' => 'country_id',
      'context' => 'abbreviate',
    ]);
    $this->assertContains('US', $result['values']);
    $this->assertNotContains('United States', $result['values']);
    $result = $this->callAPISuccess('Address', 'getoptions', [
      'field' => 'state_province_id',
      'context' => 'abbreviate',
    ]);
    $this->assertContains('AL', $result['values']);
    $this->assertNotContains('Alabama', $result['values']);
  }

  /**
   * Ensure an update to the second address doesn't cause error.
   *
   * Avoid "db error: already exists" when re-saving the custom fields.
   */
  public function testUpdateSharedAddressWithCustomFields(): void {
    $ids = $this->entityCustomGroupWithSingleFieldCreate(__FUNCTION__, __FILE__);
    $params = $this->_params;
    $params['custom_' . $ids['custom_field_id']] = 'custom string';
    $firstAddress = $this->callAPISuccess($this->_entity, 'create', $params);
    $contactIdB = $this->individualCreate();

    $secondAddressParams = array_merge(['contact_id' => $contactIdB, 'master_id' => $firstAddress['id']], $firstAddress);
    unset($secondAddressParams['id']);
    $secondAddress = $this->callAPISuccess('Address', 'create', $secondAddressParams);
    $this->callAPISuccess('Address', 'create', ['id' => $secondAddress['id'], 'contact_id' => $contactIdB, 'master_id' => $firstAddress['id']]);
  }

  /**
   * Ensure that when geocoding fails and geocoders return the string 'null' that it is not translated into int 0 for geo_code_1 and geo_code_2 which would place the contact on null island (0,0)
   */
  public function testGeocodingAddress(): void {
    $this->callAPISuccess('Setting', 'create', ['geoProvider' => 'TestProvider']);
    $cid = $this->individualCreate();
    $r = $this->callAPISuccess('Address', 'create', [
      'contact_id' => $cid,
      'location_type_id' => 1,
      // Trigger geocoding to return 'null's for geo_code_1 and geo_code_2
      'street_address' => 'Does not exist',
      'city' => 'Hereville',
      //'US',
      'country_id' => 'US',
      // 'California',
      'state_province_id' => 'California',
      'postal_code' => '94100',
    ]);
    $createdAddress = $this->callAPISuccess('Address', 'get', ['id' => $r['id']])['values'][$r['id']];
    // If we have stored NULL values, then geo_code_1 should not be returned.
    $this->assertFalse(isset($createdAddress['geo_code_1']));
  }

}
