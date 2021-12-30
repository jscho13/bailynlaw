<?php

namespace com\cminds\listmanager\plugin\taxonomies;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\helpers\ViewHelper;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;

class TagTaxonomy extends TaxonomyAbstract {

    const TAXONOMY = 'cmlm_tag';

    public function __construct() {
        parent::__construct();
        add_action('admin_menu', array($this, 'actionAdminMenu'));
        add_action('admin_head', array($this, 'actionAdminHead'));
        add_action(sprintf('create_%s', static::TAXONOMY), array($this, 'actionCreate'));
        add_action(sprintf('edited_%s', static::TAXONOMY), array($this, 'actionEdited'));
        add_action(sprintf('%s_add_form_fields', static::TAXONOMY), array($this, 'actionAddFormFields'));
        add_action(sprintf('%s_edit_form_fields', static::TAXONOMY), array($this, 'actionEditFormFields'));
//        add_action('quick_edit_custom_box', array($this, 'actionQuickEditCustomBox'), 10, 3);
        add_filter(sprintf('manage_edit-%s_columns', static::TAXONOMY), array($this, 'filterManageColumns'));
        add_filter(sprintf('manage_%s_custom_column', static::TAXONOMY), array($this, 'filterManageCustomColumn'), 10, 3);
        add_filter(sprintf('%s_row_actions', static::TAXONOMY), array($this, 'filterRowActions'), 10, 2);
    }

    public function actionInit() {
        parent::actionInit();
        register_taxonomy(static::TAXONOMY, NULL, array(
            'label' => 'Tags',
            'show_ui' => TRUE,
            'show_admin_column' => TRUE,
            'hierarchical' => FALSE,
            'not_found' => 'No tags found'
        ));
        wp_register_script('cmlm-backend-tag-taxonomy', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/tag-taxonomy.js', array('jquery', 'common', 'inline-edit-tax', 'wp-color-picker'), App::version(), true);
    }

    public function actionAdminEnqueueScripts() {
        if (get_current_screen()->taxonomy == static::TAXONOMY) {
            wp_enqueue_style('cmlm-backend-admin');
            if (wp_script_is('inline-edit-tax', 'enqueued')) {
                wp_enqueue_script('cmlm-backend-tag-taxonomy');
            }
        }
    }

    public function actionAdminMenu() {
        add_submenu_page(App::SLUG, 'Tags', 'Tags', 'manage_options', sprintf('edit-tags.php?taxonomy=%s', static::TAXONOMY));
    }

    public function actionAdminHead() {
        if (get_current_screen()->taxonomy == static::TAXONOMY) {
            HTMLHelper::enqueueInputColorAssets();
            //echo "<style>.form-field.term-slug-wrap{ display: none !important; }</style>\n";
            echo "<style>.form-field.term-description-wrap{ display: none !important; }</style>\n";
        }
    }

    public function actionAddFormFields() {
        echo ViewHelper::load('views/backend/taxonomies/tag/add_form_fields.php');
    }

    public function actionCreate($term_id) {
        $key = sprintf('%s_color', App::PREFIX);
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            update_term_meta($term_id, $key, $value);
        };
    }

    public function actionEdited($term_id) {
        return $this->actionCreate($term_id);
    }

    public function actionEditFormFields($term) {
        $value1 = get_term_meta($term->term_id, sprintf('%s_color', App::PREFIX), TRUE);
        echo ViewHelper::load('views/backend/taxonomies/tag/edit_form_fields.php', array('color' => $value1));
    }

    public function filterManageColumns($columns) {
        unset($columns['posts']);
        //unset($columns['slug']);
        unset($columns['description']);
        $columns[sprintf('%s_color', App::PREFIX)] = 'Color';
        return $columns;
    }

    public function filterManageCustomColumn($out, $column_name, $term_id) {
        if ($column_name === sprintf('%s_color', App::PREFIX)) {
            $color = get_term_meta($term_id, $column_name, TRUE);
            return sprintf('<span style="background: %s" class="cmlm-admin-color-dark">%s</span>', $color, $color);
        }
    }

    public function filterRowActions($actions, $tag) {
        unset($actions['view']);
        unset($actions['inline hide-if-no-js']);
        return $actions;
    }

    public function actionQuickEditCustomBox($column_name, $screen, $taxonomy = NULL) {
        if ($taxonomy !== static::TAXONOMY) {
            return;
        }
        $key = sprintf('%s_color', App::PREFIX);
        if ($column_name == $key) {
            echo ViewHelper::load('views/backend/taxonomies/common/quick_edit_custom_box.php', array(
                'name' => $column_name,
                'type' => 'text',
                'title' => 'Color'
            ));

//            $html = HTMLHelper::InputColor($column_name, null, array('class' => 'ptitle'));
//            echo ViewHelper::Load('views/backend/taxonomies/common/quick_edit_custom_box_raw.php', array(
//                'input_html' => $html,
//                'title' => 'Color'
//            ));
        }
    }

}
