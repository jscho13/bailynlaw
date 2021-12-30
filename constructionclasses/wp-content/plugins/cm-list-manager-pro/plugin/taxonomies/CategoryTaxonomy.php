<?php

namespace com\cminds\listmanager\plugin\taxonomies;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\ListTaxonomy;
use com\cminds\listmanager\plugin\helpers\ViewHelper;
use com\cminds\listmanager\plugin\misc\Misc;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;
use com\cminds\listmanager\plugin\options\Options;

class CategoryTaxonomy extends TaxonomyAbstract {

    const TAXONOMY = 'cmlm_category';

    public function __construct() {
        parent::__construct();
        add_action('admin_menu', array($this, 'actionAdminMenu'));
        add_action('admin_head', array($this, 'actionAdminHead'));
        add_action(sprintf('%s_add_form_fields', static::TAXONOMY), array($this, 'actionAddFormFields'));
        add_action(sprintf('%s_edit_form_fields', static::TAXONOMY), array($this, 'actionEditFormFields'));
        add_action(sprintf('create_%s', static::TAXONOMY), array($this, 'actionCreate'));
        add_action(sprintf('edited_%s', static::TAXONOMY), array($this, 'actionEdited'));
        add_filter(sprintf('%s_row_actions', static::TAXONOMY), array($this, 'filterRowActions'), 10, 2);
        add_filter(sprintf('manage_edit-%s_columns', static::TAXONOMY), array($this, 'filterManageColumns'));
        add_filter(sprintf('manage_%s_custom_column', static::TAXONOMY), array($this, 'filterManageCustomColumn'), 10, 3);
    }

    public function actionInit() {
        parent::actionInit();
        register_taxonomy(self::TAXONOMY, NULL, array(
            'label' => 'Categories',
            'show_ui' => TRUE,
            'show_admin_column' => TRUE,
            'hierarchical' => TRUE
        ));
        wp_register_script('cmlm-backend-category-taxonomy', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/category-taxonomy.js', array('jquery', 'common'), App::version(), true);
		wp_register_script('cmlm-backend-options', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/options.js', array('jquery', 'common'), App::version());
    }

    public function actionAdminMenu() {
        add_submenu_page(App::SLUG, 'Categories', 'Categories', 'manage_options', 'edit-tags.php?taxonomy=cmlm_category');
    }

    public function actionAdminHead() {
        if (get_current_screen()->taxonomy == static::TAXONOMY) {
            HTMLHelper::enqueueInputColorAssets();
            //echo "<style>.form-field.term-slug-wrap{ display: none !important; }</style>\n";
            //echo "<style>.inline-edit-col label:nth-child(2){ display: none !important; }</style>\n";
        }
    }

    public function actionAdminEnqueueScripts() {
        if (get_current_screen()->taxonomy == static::TAXONOMY) {
            wp_enqueue_script('cmlm-backend-category-taxonomy');
			wp_enqueue_script('cmlm-backend-options');
            wp_enqueue_style('cmlm-backend-admin');
        }
    }

    public function actionAddFormFields() {
        echo ViewHelper::load('views/backend/taxonomies/category/add_form_fields.php');
    }

    public function actionEditFormFields($term) {
        $value1 = get_term_meta($term->term_id, sprintf('%s_list', App::PREFIX));
        $value2 = get_term_meta($term->term_id, sprintf('%s_bg_color', App::PREFIX), TRUE);
        $value3 = get_term_meta($term->term_id, sprintf('%s_category_link', App::PREFIX), TRUE);
        $who_access = get_term_meta($term->term_id, sprintf('%s_category_access_list', App::PREFIX), TRUE);
		$author_id = get_term_meta($term->term_id, sprintf('%s_category_author', App::PREFIX), TRUE);
		$author_id = !empty($author_id) ? $author_id : get_current_user_id();
		
		if ( empty($who_access) )	$who_access = Options::DEFAULT_ACCESS;
		$access_roles = array(Options::ADMIN_ROLE);
		if ( $who_access == Options::SELECTED_ROLES ) {
			$access_roles =  (array) get_term_meta($term->term_id, sprintf('%s_category_access_roles', App::PREFIX), TRUE) ?: $access_roles;
		}
		echo ViewHelper::load('views/backend/taxonomies/category/edit_form_fields.php', array(
			'list_id_arr' => $value1,
			'bg_color' => $value2,
			'category_link' => $value3,
			'who_access' => $who_access,
			'access_roles' => $access_roles,
			'author_id' => $author_id,
		));
    }

    public function actionCreate($term_id) {
        $key = sprintf('%s_list', App::PREFIX);
        if (isset($_POST['tax_input']) && is_array($_POST['tax_input'][$key])) {
            $value = $_POST['tax_input'][$key];
            Misc::update_term_meta_array($term_id, $key, $value);
        } else {
            if (filter_input(INPUT_POST, 'action') == 'editedtag') {
                delete_term_meta($term_id, $key);
            }
        }
		
        $key = sprintf('%s_bg_color', App::PREFIX);
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            update_term_meta($term_id, $key, $value);
        }
		
        $key = sprintf('%s_category_link', App::PREFIX);
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            update_term_meta($term_id, $key, $value);
        }
		
        $key = sprintf('%s_category_author', App::PREFIX);
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            update_term_meta($term_id, $key, $value);
        }
		
        $key = sprintf('%s_category_access_list', App::PREFIX);
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            update_term_meta($term_id, $key, $value);
			if ( $value == Options::SELECTED_ROLES ) {
				$subkey = sprintf('%s_category_access_roles', App::PREFIX);
				if (isset($_POST[$subkey])) {
					$value = $_POST[$subkey];
					if ( !in_array(Options::ADMIN_ROLE, $value) ) {
						$value[] = Options::ADMIN_ROLE;
					}
					update_term_meta($term_id, $subkey, $value);
				}
			}
        }
    }

    public function actionEdited($term_id) {
        return $this->actionCreate($term_id);
    }

    public function filterRowActions($actions, $tag) {
        unset($actions['view']);
        unset($actions['inline hide-if-no-js']);
        return $actions;
    }

    public function filterManageColumns($columns) {
        unset($columns['posts']);
        //unset($columns['slug']);
        $columns[sprintf('%s_list', App::PREFIX)] = 'Lists';
        $columns[sprintf('%s_bg_color', App::PREFIX)] = 'Background color';
        return $columns;
    }

    public function filterManageCustomColumn($out, $column_name, $term_id) {
        if ($column_name === sprintf('%s_bg_color', App::PREFIX)) {
            $color = get_term_meta($term_id, $column_name, TRUE);
            return sprintf('<span style="background: %s" class="cmlm-admin-color">%s</span>', $color, $color);
        }
        if ($column_name === sprintf('%s_list', App::PREFIX)) {
            $arr_id = get_term_meta($term_id, $column_name);
            if (!$arr_id) {
                return;
            }
            $items = get_terms(ListTaxonomy::TAXONOMY, array(
                'hide_empty' => FALSE,
                'hierarchical' => FALSE,
                'include' => implode(',', $arr_id)
            ));
            echo implode(', ', array_map(function($item) {
                        return $item->name;
                    }, $items));
        }
    }
	
	public static function isVisible($term_id) {
		$allowed_users = Options::ALL_USERS; // by default a category is visible to all
		$allowed_roles = (array) Options::getOption('category_access_roles');
		$allowed_for_this_term = get_term_meta($term_id, sprintf('%s_category_access_list', App::PREFIX), TRUE); // get access level for current term
		if ( !empty($allowed_for_this_term) && $allowed_for_this_term != Options::DEFAULT_ACCESS ) {
			$allowed_users = $allowed_for_this_term;
			if ( $allowed_for_this_term == Options::SELECTED_ROLES ) {
				$allowed_roles = (array) get_term_meta($term_id, sprintf('%s_category_access_roles', App::PREFIX), TRUE);
			}
		} else {
			if ( null !== Options::getOption('category_access_list') ) {
				$allowed_users = Options::getOption('category_access_list'); // get access level defined by default options
			}
		}
		
		if ( $allowed_users == Options::ALL_USERS ) {
			return true;
		}
		
		if ( $allowed_users == Options::REGISTERED_USERS ) {
			return (bool) is_user_logged_in();
		}

		if ( $allowed_users == Options::PERSONAL_ACCESS ) {
			$author_id = get_term_meta($term_id, sprintf('%s_category_author', App::PREFIX), TRUE);
			if ( !empty($author_id) && $author_id != 0 ) {
				return get_current_user_id() == $author_id;
			}
			return true;
		}

		if ( $allowed_users == Options::SELECTED_ROLES ) {
			$user_id = get_current_user_id();
			if ( 0 != $user_id ) {
				$user_meta = get_userdata($user_id);
				$user_roles = (array) $user_meta->roles;
				foreach ($allowed_roles as $role) {
					if ( in_array(strtolower($role), $user_roles) ) {
						return true;
					}
				}
			}
		}
		return false;
	}

    public static function clearLists(array $lists) {
        $cat_terms = get_terms( array(
            'taxonomy'   => static::TAXONOMY,
            'hide_empty' => false,
            'meta_query' => array(
                'relation' => 'AND', 
                array(
                    'key'     => sprintf('%s_list', App::PREFIX),
                    'value'   => $lists,
                    'compare' => 'IN'
                )
            )
        ) );
        $cat_terms_ids = array();
        if($cat_terms){
            $cat_terms_ids = wp_list_pluck( $cat_terms, 'term_id' );
            foreach ( $cat_terms as $term ) {
                wp_delete_term($term->term_id, static::TAXONOMY); 
            }
        }
        return $cat_terms_ids;
    }

}
