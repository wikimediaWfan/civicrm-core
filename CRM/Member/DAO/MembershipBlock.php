<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Member/MembershipBlock.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:a79f50e3b6f6922604ad809e6791f816)
 */

/**
 * Database access object for the MembershipBlock entity.
 */
class CRM_Member_DAO_MembershipBlock extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '1.5';
  const COMPONENT = 'CiviMember';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_membership_block';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Membership ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Name for Membership Status
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_table;

  /**
   * FK to civicrm_contribution_page.id
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_id;

  /**
   * Membership types to be exposed by this block
   *
   * @var string|null
   *   (SQL type: varchar(1024))
   *   Note that values will be retrieved from the database as a string.
   */
  public $membership_types;

  /**
   * Optional foreign key to membership_type
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $membership_type_default;

  /**
   * Display minimum membership fee
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $display_min_fee;

  /**
   * Should membership transactions be processed separately
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_separate_payment;

  /**
   * Title to display at top of block
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $new_title;

  /**
   * Text to display below title
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $new_text;

  /**
   * Title for renewal
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $renewal_title;

  /**
   * Text to display for member renewal
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $renewal_text;

  /**
   * Is membership sign up optional
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_required;

  /**
   * Is this membership_block enabled
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_membership_block';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Membership Blocks') : ts('Membership Block');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'entity_id', 'civicrm_contribution_page', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'membership_type_default', 'civicrm_membership_type', 'id');
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
          'title' => ts('Membership Block ID'),
          'description' => ts('Membership ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.id',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '1.5',
        ],
        'entity_table' => [
          'name' => 'entity_table',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Membership Block Entity Table'),
          'description' => ts('Name for Membership Status'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.entity_table',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'add' => '1.5',
        ],
        'entity_id' => [
          'name' => 'entity_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Entity ID'),
          'description' => ts('FK to civicrm_contribution_page.id'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.entity_id',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contribute_DAO_ContributionPage',
          'html' => [
            'label' => ts("Entity"),
          ],
          'add' => '1.5',
        ],
        'membership_types' => [
          'name' => 'membership_types',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Membership Block Membership Types'),
          'description' => ts('Membership types to be exposed by this block'),
          'maxlength' => 1024,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.membership_types',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'serialize' => self::SERIALIZE_PHP,
          'add' => '1.5',
        ],
        'membership_type_default' => [
          'name' => 'membership_type_default',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Default Type ID'),
          'description' => ts('Optional foreign key to membership_type'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.membership_type_default',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'FKClassName' => 'CRM_Member_DAO_MembershipType',
          'html' => [
            'label' => ts("Default Type"),
          ],
          'add' => '1.5',
        ],
        'display_min_fee' => [
          'name' => 'display_min_fee',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Membership Block Display Minimum Fee'),
          'description' => ts('Display minimum membership fee'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.display_min_fee',
          'default' => '1',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'add' => '1.5',
        ],
        'is_separate_payment' => [
          'name' => 'is_separate_payment',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Membership Block Is Separate Payment'),
          'description' => ts('Should membership transactions be processed separately'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.is_separate_payment',
          'default' => '1',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'add' => '1.5',
        ],
        'new_title' => [
          'name' => 'new_title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Membership Block New Title'),
          'description' => ts('Title to display at top of block'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.new_title',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 1,
          'add' => '1.5',
        ],
        'new_text' => [
          'name' => 'new_text',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Membership Block New Text'),
          'description' => ts('Text to display below title'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.new_text',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 1,
          'add' => '1.5',
        ],
        'renewal_title' => [
          'name' => 'renewal_title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Membership Block Renewal Title'),
          'description' => ts('Title for renewal'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.renewal_title',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 1,
          'add' => '1.5',
        ],
        'renewal_text' => [
          'name' => 'renewal_text',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Membership Block Renewal Text'),
          'description' => ts('Text to display for member renewal'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.renewal_text',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 1,
          'add' => '1.5',
        ],
        'is_required' => [
          'name' => 'is_required',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Is Required'),
          'description' => ts('Is membership sign up optional'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.is_required',
          'default' => '0',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'add' => '1.5',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Is Active'),
          'description' => ts('Is this membership_block enabled'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_membership_block.is_active',
          'default' => '1',
          'table_name' => 'civicrm_membership_block',
          'entity' => 'MembershipBlock',
          'bao' => 'CRM_Member_BAO_MembershipBlock',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '1.5',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'membership_block', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'membership_block', $prefix, []);
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
