<?php

$cminds_plugin_config = array(
    'plugin-is-pro' => TRUE,
    'plugin-has-addons' => FALSE,
    'plugin-show-shortcodes' => TRUE,
    'plugin-shortcodes-action' => com\cminds\listmanager\App::SLUG . '_supported_shortcodes',
    'plugin-shortcodes' => com\cminds\listmanager\plugin\helpers\ViewHelper::load('views/backend/licensing/plugin_shortcodes.php'),
    'plugin-version' => com\cminds\listmanager\App::version(),
    'plugin-abbrev' => com\cminds\listmanager\App::SLUG,
    'plugin-short-slug' => com\cminds\listmanager\App::SLUG,
    'plugin-parent-short-slug' => '',
    'plugin-affiliate' => '',
    'plugin-show-guide' => FALSE,
    'plugin-guide-text' => '<p>Using the CM List Manager you can create unlimited amount of curated lists of links grouped by categories and tags</p><p>Each link has its own description and favicon. Lists have easy search and filtering utilities.</p>',
    'plugin-guide-video-height' => 180,
    'plugin-guide-videos' => array(),
    'plugin-redirect-after-install' => admin_url('admin.php?page=cmlm-options'),
    'plugin-file' => com\cminds\listmanager\App::PLUGIN_FILE,
    'plugin-dir-path' => plugin_dir_path(com\cminds\listmanager\App::PLUGIN_FILE),
    'plugin-dir-url' => plugin_dir_url(com\cminds\listmanager\App::PLUGIN_FILE),
    'plugin-basename' => plugin_basename(com\cminds\listmanager\App::PLUGIN_FILE),
    'plugin-icon' => '',
    'plugin-name' => com\cminds\listmanager\App::PLUGIN_NAME_EXTENDED,
    'plugin-license-name' => com\cminds\listmanager\App::PLUGIN_NAME_EXTENDED,
    'plugin-slug' => '',
    'plugin-menu-item' => com\cminds\listmanager\App::SLUG,
    'plugin-textdomain' => com\cminds\listmanager\App::SLUG,
    'plugin-userguide-key' => '663-cm-curated-list-manager-cmclm',
    'plugin-store-url' => 'https://www.cminds.com/wordpress-plugins-library/curated-list-manager-and-knowledgebase-plugin-for-wordpress/',
    'plugin-support-url' => '',
    'plugin-review-url' => '',
    'plugin-changelog-url' => 'https://www.cminds.com/wordpress-plugins-library/curated-list-manager-and-knowledgebase-plugin-for-wordpress/#changelog',
    'plugin-licensing-aliases' => array(com\cminds\listmanager\App::PLUGIN_NAME_EXTENDED),
);
