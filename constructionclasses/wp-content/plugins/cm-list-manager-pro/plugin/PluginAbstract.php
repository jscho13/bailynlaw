<?php

namespace com\cminds\listmanager\plugin;

abstract class PluginAbstract {

    const VERSION = '';
    const PREFIX = '';
    const SLUG = '';
    const PLUGIN_NAME = '';
    const PLUGIN_NAME_EXTENDED = '';
    const PLUGIN_FILE = '';
    public static $mysql_regexp_markers = array();
    public static $wp_datetime_format;
    public static $wp_date_format;

    public function __construct() {

        new taxonomies\ListTaxonomy();
        new taxonomies\CategoryTaxonomy();
        new taxonomies\LinkTaxonomy();
        new taxonomies\TagTaxonomy();
        new options\Options();
        new pages\ImportExportPage();
        new shortcodes\Shortcode();
        new widgets\CategoryWidget();
        new services\ExportService();
        notices\AdminNoticeManager::init();

        add_action('admin_menu', array($this, 'actionAdminMenu'));
        add_action('init', array($this, 'actionInit'));

        $this->setupMysqlRegexpMarkers();
    }

    public function actionAdminMenu() {
        add_menu_page(static::SLUG, static::PLUGIN_NAME_EXTENDED, 'manage_options', static::SLUG, function($q){return;}, 'dashicons-list-view');
    }

    public function actionInit() {
        wp_register_style('cmlm-backend-admin', plugin_dir_url(static::PLUGIN_FILE) . 'assets/backend/css/admin.css', array(), static::version());
    }

    private function setupMysqlRegexpMarkers() {
      global $wpdb;
      $mysqlVersion = $wpdb->db_version();
      if(intval($mysqlVersion) < 8){
        self::$mysql_regexp_markers = array('[[:<:]]', '[[:>:]]');
      }else{
        self::$mysql_regexp_markers = array('\b', '\b');
      }
      return self::$mysql_regexp_markers;
    }

    public static function getWpDateTimeFormat() {
        self::$wp_datetime_format = get_option('date_format') . " " . get_option('time_format');
        return self::$wp_datetime_format;
    }

    public static function getWpDateFormat() {
        self::$wp_date_format = get_option('date_format');
        return self::$wp_date_format;
    }

}
