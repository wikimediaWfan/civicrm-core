<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Friend/Friend.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:b837e6691ca658a0ba6bb86119518f13)
 */

/**
 * Database access object for the Friend entity.
 */
class CRM_Friend_DAO_Friend extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '2.0';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_tell_friend';

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
   * Friend ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Name of table where item being referenced is stored.
   *
   * @var string
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_table;

  /**
   * Foreign key to the referenced item.
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $entity_id;

  /**
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $title;

  /**
   * Introductory message to contributor or participant displayed on the Tell a Friend form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $intro;

  /**
   * Suggested message to friends, provided as default on the Tell A Friend form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $suggested_message;

  /**
   * URL for general info about the organization - included in the email sent to friends.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $general_link;

  /**
   * Text for Tell a Friend thank you page header and HTML title.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $thankyou_title;

  /**
   * Thank you message displayed on success page.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $thankyou_text;

  /**
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_tell_friend';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Friends') : ts('Friend');
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
          'title' => ts('Friend ID'),
          'description' => ts('Friend ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.id',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '2.0',
        ],
        'entity_table' => [
          'name' => 'entity_table',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Entity Table'),
          'description' => ts('Name of table where item being referenced is stored.'),
          'required' => TRUE,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.entity_table',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 0,
          'add' => '2.0',
        ],
        'entity_id' => [
          'name' => 'entity_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Entity ID'),
          'description' => ts('Foreign key to the referenced item.'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.entity_id',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 0,
          'add' => '2.0',
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Title'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.title',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'intro' => [
          'name' => 'intro',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Intro'),
          'description' => ts('Introductory message to contributor or participant displayed on the Tell a Friend form.'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.intro',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'suggested_message' => [
          'name' => 'suggested_message',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Suggested Message'),
          'description' => ts('Suggested message to friends, provided as default on the Tell A Friend form.'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.suggested_message',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'general_link' => [
          'name' => 'general_link',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('General Link'),
          'description' => ts('URL for general info about the organization - included in the email sent to friends.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => TRUE,
            'export' => TRUE,
            'duplicate_matching' => TRUE,
            'token' => FALSE,
          ],
          'import' => TRUE,
          'where' => 'civicrm_tell_friend.general_link',
          'export' => TRUE,
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'thankyou_title' => [
          'name' => 'thankyou_title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Thank You Title'),
          'description' => ts('Text for Tell a Friend thank you page header and HTML title.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.thankyou_title',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'thankyou_text' => [
          'name' => 'thankyou_text',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Thank You Text'),
          'description' => ts('Thank you message displayed on success page.'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.thankyou_text',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.0',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Enabled?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_tell_friend.is_active',
          'default' => '1',
          'table_name' => 'civicrm_tell_friend',
          'entity' => 'Friend',
          'bao' => 'CRM_Friend_BAO_Friend',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '2.0',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'tell_friend', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'tell_friend', $prefix, []);
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
