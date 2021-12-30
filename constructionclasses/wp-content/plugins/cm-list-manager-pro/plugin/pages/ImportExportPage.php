<?php

namespace com\cminds\listmanager\plugin\pages;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin;
use com\cminds\listmanager\plugin\services\ImportService;
use com\cminds\listmanager\plugin\services\CategoryImportService;
use com\cminds\listmanager\plugin\notices\AdminNoticeManager;
use com\cminds\listmanager\plugin\notices\AdminNotice;

class ImportExportPage extends PageAbstract {

    const NONCE = 'cmlm_import_export_page_nonce';
	const CAT_IMPORT_NONCE = 'cmlm_category_import_service_nonce';
    public function __construct() {

    add_action('admin_init', function() {
        if (is_admin()) {
            if (wp_verify_nonce(filter_input(INPUT_POST, static::NONCE), static::NONCE) && isset($_FILES['file'])) {
                ini_set("auto_detect_line_endings", true);
                $service = new ImportService();

                $key = sprintf('%s_list', App::PREFIX);
                $lists = array();
                if (isset($_POST['tax_input']) && isset($_POST['tax_input'][$key]) && is_array($_POST['tax_input'][$key])) {
                    $lists = $_POST['tax_input'][$key];
                }

                if($lists && filter_input(INPUT_POST, 'rewrite_links')){
                    $service->processFile($_FILES['file']['tmp_name'])
                            ->skipHeader(filter_input(INPUT_POST, 'skip_header'))
                            ->clearLinkFromLists($lists)
                            ->import();
                }else{
                    $service->processFile($_FILES['file']['tmp_name'])
                            ->skipHeader(filter_input(INPUT_POST, 'skip_header'))
                            ->import();
                }
                AdminNoticeManager::enqueue(new AdminNotice(uniqid(), 'updated', sprintf('%s file is imported.', $_FILES['file']['name'])));


            } else if (wp_verify_nonce(filter_input(INPUT_POST, static::CAT_IMPORT_NONCE), static::CAT_IMPORT_NONCE)) {
                $service = new CategoryImportService();
                $import_result = $service->import(filter_input(INPUT_POST, CategoryImportService::IMPORT_POSTS));
                AdminNoticeManager::enqueue(new AdminNotice(uniqid(), 'updated', sprintf('%s categories and %s links imported.', $import_result[0], $import_result[1])));
            }
        }
    });

        add_action('admin_menu', function() {
            add_submenu_page(App::SLUG, 'Import &amp; Export', 'Import &amp; Export', 'manage_options', sprintf('%s-import-export', App::PREFIX), array($this, 'render'));
        }, 20);
    }

    public function getRender($arr = array()) {
        return parent::getRender(array(
                    'title' => sprintf('%s - %s', App::PLUGIN_NAME_EXTENDED, 'Import &amp; Export'),
                    'content' => plugin\helpers\ViewHelper::load('views/backend/pages/import_export/import_export.php')
        ));
    }

}
