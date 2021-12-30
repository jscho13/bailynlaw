<?php



namespace com\cminds\listmanager\plugin\options;



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\helpers\ViewHelper;

use com\cminds\listmanager\plugin\helpers\HTMLHelper;



class Options {

	const ALL_USERS = 'all_users';

	const REGISTERED_USERS = 'registered_users';

	const SELECTED_ROLES = 'selected_roles';

	const DEFAULT_ACCESS = 'default';

	const ADMIN_ROLE = 'administrator';

	const PERSONAL_ACCESS = 'personal_access';

	

    private static $defaultOptions = array(

        'columns_count' => 2,

        'favicons_display' => 1,

        'favicons_local_cache' => 0,

        'links_rel_nofollow' => 0,

        'links_target_blank' => 0,

        'show_checkboxes' => 0,

        'show_search_and_filter' => 1,

        'user_display_categories' => 1,

        'show_bonus_info' => 1,

        'bonus_info_format' => '<strong>List updated on </strong>{last-update-date}. <strong>Total number of items:</strong> {links-count}.',

        'category_font_size' => NULL,

        'category_background_color' => NULL,

        'category_text_color' => NULL,

        'link_font_size' => NULL,

        'link_word_break' => 'break-word',

        'link_subtitle_font_size' => NULL,

        'link_show_subtitle' => NULL,

        'link_hover_color' => NULL,

        'link_image_width' => '30px',

        'link_image_height' => '30px',

		'link_video_width' => '560px',

        'link_video_height' => '315px',

        'tagfile1_link_background_color' => '#fff',

        'tagfile2_link_background_color' => '#fff',

        'tagfile3_link_background_color' => '#fff',

		'show_tagfile_icon'           => true,

		'show_tooltip_on_category'    => false,

        'tooltip_background_color' => NULL,

        'tooltip_border_color' => NULL,

        'tooltip_text_color' => NULL,

        'new_tag_id' => -1,

        'new_tag_duration' => 259200,

        'link_order_by' => 'default',

        'link_social_buttons' => false,

        'link_social_buttons_in_new_line' => false,

        'link_social_buttons_expand_on_hover' => false,

        'link_social_facebook' => true,

        'link_social_twitter' => true,

        'link_social_google' => true,

        'link_social_linkedin' => true,

        'link_social_pinterest' => true,

        'link_social_buffer' => true,

        'link_social_tumblr' => true,

        'link_social_reddit' => true,

        'icon_size' => '25px',

        'icon_opacity' => 0.5,

        'tooltip_font_size' => NULL,

        'link_opacity' => 0.75,

        'link_subtitle_color' => NULL,

        'link_title_color' => NULL,

        'items_per_page' => 0,

        'link_like_button' => NULL,

        'label_search_placeholder' => 'Search ...',

        'label_for_search_input' => 'Search',

        'all_categories_label' => 'All',

        'cmlm_category_label' => 'category',

		'category_access_list' => self::ALL_USERS,

		'category_access_roles' => array(self::ADMIN_ROLE),

        'show_event_date' => NULL,

        'show_sortby_event_date' => NULL,

        'event_date_font_size' => NULL,

        'event_date_font_style' => 'normal',

        'event_date_text_color' => NULL,

    );



    public function __construct() {

        add_action('init', array($this, 'actionInit'));

        add_action('admin_head', array($this, 'actionAdminHead'));

        add_action('admin_menu', array($this, 'actionAdminMenu'), 20);

    }



    public function actionInit() {

        if (isset($_POST['cmlm_action_update']) && isset($_POST['nonce']) && is_admin()) {

            if (wp_verify_nonce($_POST['nonce'], 'cmlm_action_update')) {

                foreach ($_POST as $k => $v) {

                    $this->updateOption($k, $v);

                }

            }

        }



    }



    public function actionAdminHead() {

        if (preg_match('/_cmlm-options$/', get_current_screen()->id)) {

            HTMLHelper::enqueueInputColorAssets();

			wp_enqueue_style( 'cmlm-backend-admin' );

			wp_enqueue_script('cmlm-backend-options', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/options.js', array('jquery', 'common'), App::version());

        }

    }



    public function actionAdminMenu() {

        add_submenu_page(App::SLUG, 'Options', 'Options', 'manage_options', sprintf('%s-options', App::PREFIX), array($this, 'displayOptionsPage'));

    }



    public function displayOptionsPage() {

        $content = ViewHelper::load('views/backend/options/options.php');

        echo ViewHelper::load('views/backend/options/template.php', array(

            'nav' => $this->nav(),

            'content' => $content)

        );

    }



    public static function getOption($option) {

        if (static::isValidOption($option)) {

            return get_option(sprintf('%s_%s', App::PREFIX, $option), static::$defaultOptions[$option]);

        } else {

            return NULL;

        }

    }



    public static function updateOption($option, $value) {

        if (static::isValidOption($option)) {

            return update_option(sprintf('%s_%s', App::PREFIX, $option), $value);

        } else {

            return FALSE;

        }

    }



    public static function isValidOption($option) {

        return key_exists($option, static::$defaultOptions);

    }



    private static function nav() {

        global $self, $parent_file, $submenu_file, $plugin_page, $typenow, $submenu;

        $submenus = array();



        $menuItem = App::SLUG;



        if (isset($submenu[$menuItem])) {

            $thisMenu = $submenu[$menuItem];



            foreach ($thisMenu as $sub_item) {

                $slug = $sub_item[2];



                // Handle current for post_type=post|page|foo pages, which won't match $self.

                $self_type = !empty($typenow) ? $self . '?post_type=' . $typenow : 'nothing';



                $isCurrent = FALSE;

                $subpageUrl = get_admin_url('', 'admin.php?page=' . $slug);



                if ((!isset($plugin_page) && $self == $slug) || (isset($plugin_page) && $plugin_page == $slug && ($menuItem == $self_type || $menuItem == $self || file_exists($menuItem) === false))) {

                    $isCurrent = TRUE;

                }



                $url = (strpos($slug, '.php') !== false || strpos($slug, 'http') !== false) ? $slug : $subpageUrl;

                $isExternalPage = strpos($slug, 'http') !== FALSE;

                $submenus[] = array(

                    'link' => $url,

                    'title' => $sub_item[0],

                    'current' => $isCurrent,

                    'target' => $isExternalPage ? '_blank' : ''

                );

            }

        }

        return ViewHelper::load('views/backend/options/nav.php', array('submenus' => $submenus));

    }



}

