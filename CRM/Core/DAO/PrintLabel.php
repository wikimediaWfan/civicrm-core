<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Core/PrintLabel.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:53efa9e6a15294d0acdc98f16923d6c7)
 */

/**
 * Database access object for the PrintLabel entity.
 */
class CRM_Core_DAO_PrintLabel extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '4.4';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_print_label';

  /**
   * Field to show when displaying a record.
   *
   * @var string
   */
  public static $_labelField = 'title';

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
   * User title for this label layout
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $title;

  /**
   * variable name/programmatic handle for this field.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * Description of this label layout
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $description;

  /**
   * This refers to name column of civicrm_option_value row in name_badge option group
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $label_format_name;

  /**
   * Implicit FK to civicrm_option_value row in NEW label_type option group
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $label_type_id;

  /**
   * contains json encode configurations options
   *
   * @var string|null
   *   (SQL type: longtext)
   *   Note that values will be retrieved from the database as a string.
   */
  public $data;

  /**
   * Is this default?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_default;

  /**
   * Is this option active?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Is this reserved label?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_reserved;

  /**
   * FK to civicrm_contact, who created this label layout
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $created_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_print_label';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Print Labels') : ts('Print Label');
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
          'title' => ts('Print Label ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.id',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '4.4',
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Title'),
          'description' => ts('User title for this label layout'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.title',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Name'),
          'description' => ts('variable name/programmatic handle for this field.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.name',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'description' => [
          'name' => 'description',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Description'),
          'description' => ts('Description of this label layout'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.description',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'label' => ts("Description"),
          ],
          'add' => '4.4',
        ],
        'label_format_name' => [
          'name' => 'label_format_name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Label Format'),
          'description' => ts('This refers to name column of civicrm_option_value row in name_badge option group'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.label_format_name',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'optionGroupName' => 'name_badge',
            'optionEditPath' => 'civicrm/admin/options/name_badge',
          ],
          'add' => '4.4',
        ],
        'label_type_id' => [
          'name' => 'label_type_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Label Type'),
          'description' => ts('Implicit FK to civicrm_option_value row in NEW label_type option group'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.label_type_id',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'optionGroupName' => 'label_type',
            'optionEditPath' => 'civicrm/admin/options/label_type',
          ],
          'add' => '4.4',
        ],
        'data' => [
          'name' => 'data',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => ts('Data'),
          'description' => ts('contains json encode configurations options'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.data',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'serialize' => self::SERIALIZE_JSON,
          'html' => [
            'label' => ts("Data"),
          ],
          'add' => '4.4',
        ],
        'is_default' => [
          'name' => 'is_default',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Label is Default?'),
          'description' => ts('Is this default?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.is_default',
          'default' => '1',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Default"),
          ],
          'add' => '4.4',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Label Is Active?'),
          'description' => ts('Is this option active?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.is_active',
          'default' => '1',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '4.4',
        ],
        'is_reserved' => [
          'name' => 'is_reserved',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Is Label Reserved?'),
          'description' => ts('Is this reserved label?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.is_reserved',
          'default' => '1',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'created_id' => [
          'name' => 'created_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Created By Contact ID'),
          'description' => ts('FK to civicrm_contact, who created this label layout'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_print_label.created_id',
          'table_name' => 'civicrm_print_label',
          'entity' => 'PrintLabel',
          'bao' => 'CRM_Core_DAO_PrintLabel',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Contact',
          'html' => [
            'label' => ts("Created By"),
          ],
          'add' => '4.4',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'print_label', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'print_label', $prefix, []);
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
