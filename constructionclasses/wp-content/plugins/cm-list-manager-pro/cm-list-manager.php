<?php

/*
  Plugin Name: CM Curated List Manager Pro
  Plugin URI: https://www.cminds.com/wordpress-plugins-library/curated-list-manager-and-knowledgebase-plugin-for-wordpress/
  Description: Lets you build curated boards of links with added description organized by categories and supported by filtering tools. This is a perfect tool for gathering and sharing knowledge.
  Author: CreativeMindsSolutions
  Author URI: https://www.cminds.com/
  Version: 1.3.1
 */

namespace com\cminds\listmanager;

if (version_compare('5.4', PHP_VERSION, '>')) {
    die(sprintf('We are sorry, but you need to have at least PHP 5.3 to run this plugin (currently installed version: %s)'
                    . ' - please upgrade or contact your system administrator.', PHP_VERSION));
}



if (!class_exists('com\cminds\listmanager\App')) {

    require_once plugin_dir_path(__FILE__) . 'plugin/Psr4AutoloaderClass.php';

    $loader = new plugin\Psr4AutoloaderClass();
    $loader->register();
    $loader->addNamespace(__NAMESPACE__, untrailingslashit(plugin_dir_path(__FILE__)));

    class App extends plugin\PluginAbstract {

        const VERSION = '1.3.1';
        const PREFIX = 'cmlm';
        const SLUG = 'cm-list-manager';
        const PLUGIN_NAME = 'List Manager';
        const PLUGIN_NAME_EXTENDED = 'Curated List Manager Pro';
        const PLUGIN_FILE = __FILE__;
        const CMLM_DEBUG = 0;
        const CSV_DELIMITER = ';';
        const CSV_DATE_FORMAT = "d.m.Y H:i";
	
		public static function version() {
			if ( 1 === (int) self::CMLM_DEBUG ) {
				return time();
			}
			return self::VERSION;
		}
    }

    include_once plugin_dir_path(__FILE__) . 'bundle/licensing/cminds-pro.php';

    include_once plugin_dir_path(__FILE__) . 'bundle/wp-term-order/wp-term-order.php';

    new App();

} else {
    die('Plugin is already activated.');
}
