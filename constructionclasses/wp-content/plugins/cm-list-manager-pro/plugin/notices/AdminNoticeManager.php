<?php

namespace com\cminds\listmanager\plugin\notices;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\notices\AdminNotice;

class AdminNoticeManager {

    private static $sessionKey = 'session_key';

    public static function init() {
        add_action('init', array(get_called_class(), 'actionInit'));
        add_action('admin_notices', array(get_called_class(), 'actionAdminNotices'));
    }

    public static function actionInit() {
        // if (!session_id()) {
            // session_start();
        // }
        self::$sessionKey = sprintf('%s_admin_notice_manager', App::PREFIX);
		$notices = get_transient(self::$sessionKey);
        if ( !$notices || empty($notices) || !is_array($notices) ) {
            set_transient(self::$sessionKey, array());
        }
    }

    public static function actionAdminNotices() {
        $items = (array) get_transient(self::$sessionKey);
        foreach ($items as $item) {
            echo $item;
        }
        delete_transient(self::$sessionKey);
    }

    public static function enqueue(AdminNotice $item) {
        $items = (array) get_transient(self::$sessionKey);
        $items[] = $item;
        set_transient(self::$sessionKey, $items);
    }

}
