<?php

namespace com\cminds\listmanager\plugin\misc;

class TermOrder {

    private static $isInitialized = FALSE;

    public static function init() {
        if (!self::$isInitialized) {
            new \WP_Term_Order();
            self::$isInitialized = TRUE;
        }
    }

}
