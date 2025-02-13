<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Financial/EntityFinancialTrxn.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:9147404f8b46a55b3a5a2f1351418b82)
 */

/**
 * Database access object for the EntityFinancialTrxn entity.
 */
class CRM_Financial_DAO_EntityFinancialTrxn extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '3.2';
  const COMPONENT = 'CiviContribute';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_entity_financial_trxn';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * May contain civicrm_financial_item, civicrm_contribution, civicrm_financial_trxn, civicrm_grant, etc
   *
   * @var string
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_table;

  /**
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_id;

  /**
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $financial_trxn_id;

  /**
   * allocated amount of transaction to this entity
   *
   * @var float|string
   *   (SQL type: decimal(20,2))
   *   Note that values will be retrieved from the database as a string.
   */
  public $amount;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_entity_financial_trxn';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Entity Financial Trxns') : ts('Entity Financial Trxn');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'financial_trxn_id', 'civicrm_financial_trxn', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Dynamic(self::getTableName(), 'entity_id', NULL, 'id', 'entity_table');
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
          'title' => ts('Entity Financial Transaction ID'),
          'description' => ts('ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_entity_financial_trxn.id',
          'table_name' => 'civicrm_entity_financial_trxn',
          'entity' => 'EntityFinancialTrxn',
          'bao' => 'CRM_Financial_BAO_EntityFinancialTrxn',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '3.2',
        ],
        'entity_table' => [
          'name' => 'entity_table',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Entity Table'),
          'description' => ts('May contain civicrm_financial_item, civicrm_contribution, civicrm_financial_trxn, civicrm_grant, etc'),
          'required' => TRUE,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => TRUE,
            'export' => TRUE,
            'duplicate_matching' => TRUE,
            'token' => FALSE,
          ],
          'import' => TRUE,
          'where' => 'civicrm_entity_financial_trxn.entity_table',
          'export' => TRUE,
          'table_name' => 'civicrm_entity_financial_trxn',
          'entity' => 'EntityFinancialTrxn',
          'bao' => 'CRM_Financial_BAO_EntityFinancialTrxn',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Financial_BAO_EntityFinancialTrxn::entityTables',
          ],
          'add' => '3.2',
        ],
        'entity_id' => [
          'name' => 'entity_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Entity ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_entity_financial_trxn.entity_id',
          'table_name' => 'civicrm_entity_financial_trxn',
          'entity' => 'EntityFinancialTrxn',
          'bao' => 'CRM_Financial_BAO_EntityFinancialTrxn',
          'localizable' => 0,
          'add' => '3.2',
        ],
        'financial_trxn_id' => [
          'name' => 'financial_trxn_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Financial Transaction ID'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_entity_financial_trxn.financial_trxn_id',
          'table_name' => 'civicrm_entity_financial_trxn',
          'entity' => 'EntityFinancialTrxn',
          'bao' => 'CRM_Financial_BAO_EntityFinancialTrxn',
          'localizable' => 0,
          'FKClassName' => 'CRM_Financial_DAO_FinancialTrxn',
          'html' => [
            'label' => ts("Financial Transaction"),
          ],
          'add' => '3.2',
        ],
        'amount' => [
          'name' => 'amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Amount'),
          'description' => ts('allocated amount of transaction to this entity'),
          'required' => TRUE,
          'precision' => [
            20,
            2,
          ],
          'usage' => [
            'import' => TRUE,
            'export' => TRUE,
            'duplicate_matching' => TRUE,
            'token' => FALSE,
          ],
          'import' => TRUE,
          'where' => 'civicrm_entity_financial_trxn.amount',
          'headerPattern' => '/amount/i',
          'dataPattern' => '/^\d+(\.\d{2})?$/',
          'export' => TRUE,
          'table_name' => 'civicrm_entity_financial_trxn',
          'entity' => 'EntityFinancialTrxn',
          'bao' => 'CRM_Financial_BAO_EntityFinancialTrxn',
          'localizable' => 0,
          'add' => '3.2',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'entity_financial_trxn', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'entity_financial_trxn', $prefix, []);
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
      'UI_entity_financial_trxn_entity_table' => [
        'name' => 'UI_entity_financial_trxn_entity_table',
        'field' => [
          0 => 'entity_table',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_entity_financial_trxn::0::entity_table',
      ],
      'UI_entity_financial_trxn_entity_id' => [
        'name' => 'UI_entity_financial_trxn_entity_id',
        'field' => [
          0 => 'entity_id',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_entity_financial_trxn::0::entity_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
