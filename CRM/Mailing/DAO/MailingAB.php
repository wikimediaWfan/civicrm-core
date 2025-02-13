<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Mailing/MailingAB.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:d76d742acfe6647f447373ccf4380ecf)
 */

/**
 * Database access object for the MailingAB entity.
 */
class CRM_Mailing_DAO_MailingAB extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '';
  const COMPONENT = 'CiviMail';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_mailing_abtest';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Name of the A/B test
   *
   * @var string|null
   *   (SQL type: varchar(128))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * Status
   *
   * @var string|null
   *   (SQL type: varchar(32))
   *   Note that values will be retrieved from the database as a string.
   */
  public $status;

  /**
   * The first experimental mailing ("A" condition)
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $mailing_id_a;

  /**
   * The second experimental mailing ("B" condition)
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $mailing_id_b;

  /**
   * The final, general mailing (derived from A or B)
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $mailing_id_c;

  /**
   * Which site is this mailing for
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $domain_id;

  /**
   * @var string|null
   *   (SQL type: varchar(32))
   *   Note that values will be retrieved from the database as a string.
   */
  public $testing_criteria;

  /**
   * @var string|null
   *   (SQL type: varchar(32))
   *   Note that values will be retrieved from the database as a string.
   */
  public $winner_criteria;

  /**
   * What specific url to track
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $specific_url;

  /**
   * In how much time to declare winner
   *
   * @var string|null
   *   (SQL type: datetime)
   *   Note that values will be retrieved from the database as a string.
   */
  public $declare_winning_time;

  /**
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $group_percentage;

  /**
   * FK to Contact ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $created_id;

  /**
   * When was this item created
   *
   * @var string
   *   (SQL type: timestamp)
   *   Note that values will be retrieved from the database as a string.
   */
  public $created_date;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_mailing_abtest';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Mailing ABs') : ts('Mailing AB');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'created_id', 'civicrm_contact', 'id');
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
          'title' => ts('MailingAB ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.id',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => NULL,
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Name'),
          'description' => ts('Name of the A/B test'),
          'maxlength' => 128,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.name',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'status' => [
          'name' => 'status',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Status'),
          'description' => ts('Status'),
          'maxlength' => 32,
          'size' => CRM_Utils_Type::MEDIUM,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.status',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Mailing_PseudoConstant::abStatus',
          ],
          'add' => '4.6',
        ],
        'mailing_id_a' => [
          'name' => 'mailing_id_a',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Mailing ID (A)'),
          'description' => ts('The first experimental mailing ("A" condition)'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.mailing_id_a',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'mailing_id_b' => [
          'name' => 'mailing_id_b',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Mailing ID (B)'),
          'description' => ts('The second experimental mailing ("B" condition)'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.mailing_id_b',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'mailing_id_c' => [
          'name' => 'mailing_id_c',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Mailing ID (C)'),
          'description' => ts('The final, general mailing (derived from A or B)'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.mailing_id_c',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'domain_id' => [
          'name' => 'domain_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Domain ID'),
          'description' => ts('Which site is this mailing for'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.domain_id',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'testing_criteria' => [
          'name' => 'testing_criteria',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Testing Criteria'),
          'maxlength' => 32,
          'size' => CRM_Utils_Type::MEDIUM,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.testing_criteria',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Mailing_PseudoConstant::abTestCriteria',
          ],
          'add' => '4.6',
        ],
        'winner_criteria' => [
          'name' => 'winner_criteria',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Winner Criteria'),
          'maxlength' => 32,
          'size' => CRM_Utils_Type::MEDIUM,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.winner_criteria',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Mailing_PseudoConstant::abWinnerCriteria',
          ],
          'add' => '4.6',
        ],
        'specific_url' => [
          'name' => 'specific_url',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('URL for Winner Criteria'),
          'description' => ts('What specific url to track'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.specific_url',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'declare_winning_time' => [
          'name' => 'declare_winning_time',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Declaration Time'),
          'description' => ts('In how much time to declare winner'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.declare_winning_time',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'group_percentage' => [
          'name' => 'group_percentage',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Group Percentage'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.group_percentage',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'add' => '4.6',
        ],
        'created_id' => [
          'name' => 'created_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Created By Contact ID'),
          'description' => ts('FK to Contact ID'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.created_id',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Contact',
          'html' => [
            'label' => ts("Created By"),
          ],
          'add' => '4.6',
        ],
        'created_date' => [
          'name' => 'created_date',
          'type' => CRM_Utils_Type::T_TIMESTAMP,
          'title' => ts('AB Test Created Date'),
          'description' => ts('When was this item created'),
          'required' => FALSE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_mailing_abtest.created_date',
          'default' => 'CURRENT_TIMESTAMP',
          'table_name' => 'civicrm_mailing_abtest',
          'entity' => 'MailingAB',
          'bao' => 'CRM_Mailing_BAO_MailingAB',
          'localizable' => 0,
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'mailing',
          ],
          'add' => '4.6',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'mailing_abtest', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'mailing_abtest', $prefix, []);
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
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
