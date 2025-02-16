<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Core/WordReplacement.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:f212963034ccdf6c73970466b31552f3)
 */

/**
 * Database access object for the WordReplacement entity.
 */
class CRM_Core_DAO_WordReplacement extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '4.4';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_word_replacement';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * Word replacement ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Word which need to be replaced
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $find_word;

  /**
   * Word which will replace the word in find
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $replace_word;

  /**
   * Is this entry active?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * @var string|null
   *   (SQL type: varchar(16))
   *   Note that values will be retrieved from the database as a string.
   */
  public $match_type;

  /**
   * FK to Domain ID. This is for Domain specific word replacement
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $domain_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_word_replacement';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Word Replacements') : ts('Word Replacement');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'domain_id', 'civicrm_domain', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Word Replacement ID'),
          'description' => ts('Word replacement ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.id',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '4.4',
        ],
        'find_word' => [
          'name' => 'find_word',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Replaced Word'),
          'description' => ts('Word which need to be replaced'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.find_word',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'replace_word' => [
          'name' => 'replace_word',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Replacement Word'),
          'description' => ts('Word which will replace the word in find'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.replace_word',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Word Replacement is Active'),
          'description' => ts('Is this entry active?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.is_active',
          'default' => '1',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '4.4',
        ],
        'match_type' => [
          'name' => 'match_type',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Word Replacement Match Type'),
          'maxlength' => 16,
          'size' => CRM_Utils_Type::TWELVE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.match_type',
          'default' => 'wildcardMatch',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'callback' => 'CRM_Core_SelectValues::getWordReplacementMatchType',
          ],
          'add' => '4.4',
        ],
        'domain_id' => [
          'name' => 'domain_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Domain ID'),
          'description' => ts('FK to Domain ID. This is for Domain specific word replacement'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_word_replacement.domain_id',
          'table_name' => 'civicrm_word_replacement',
          'entity' => 'WordReplacement',
          'bao' => 'CRM_Core_BAO_WordReplacement',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_Domain',
          'html' => [
            'label' => ts("Domain"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_domain',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
          'add' => '1.1',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'word_replacement', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'word_replacement', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'UI_domain_find' => [
        'name' => 'UI_domain_find',
        'field' => [
          0 => 'domain_id',
          1 => 'find_word',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_word_replacement::1::domain_id::find_word',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
