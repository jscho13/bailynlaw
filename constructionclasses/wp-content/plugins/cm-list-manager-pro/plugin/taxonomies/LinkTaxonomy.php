<?php



namespace com\cminds\listmanager\plugin\taxonomies;



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;

use com\cminds\listmanager\plugin\helpers\ViewHelper;

use com\cminds\listmanager\plugin\notices\AdminNoticeManager;

use com\cminds\listmanager\plugin\notices\AdminNotice;

use com\cminds\listmanager\plugin\options\Options;

use com\cminds\listmanager\plugin\misc\Misc;

use com\cminds\listmanager\plugin\helpers\HTMLHelper;



class LinkTaxonomy extends TaxonomyAbstract {



    const TAXONOMY = 'cmlm_link';



    public function __construct() {

        parent::__construct();

        add_action('admin_menu', array($this, 'actionAdminMenu'));

        add_action('admin_head', array($this, 'actionAdminHead'));

        add_action(sprintf('%s_add_form_fields', static::TAXONOMY), array($this, 'actionAddFormFields'));

        add_action(sprintf('%s_edit_form_fields', static::TAXONOMY), array($this, 'actionEditFormFields'));

        add_action(sprintf('create_%s', static::TAXONOMY), array($this, 'actionCreate'));

        add_action(sprintf('edited_%s', static::TAXONOMY), array($this, 'actionEdited'));

        add_action('pre_delete_term', array($this, 'actionPreDeleteTerm'), 10, 2);

        add_action('edit_terms', array($this, 'actionEditTerms'), 10, 2);

        // add_action( 'quick_edit_custom_box', array( $this, 'actionQuickEditCustomBox' ), 10, 3 );

        add_action('admin_bar_menu', array($this, 'actionAdminBarMenu'), 99);

        add_action(sprintf('wp_ajax_%s_liked', static::TAXONOMY), array($this, 'actionLinkLiked'));

        add_action(sprintf('wp_ajax_nopriv_%s_liked', static::TAXONOMY), array($this, 'actionLinkLiked'));



        add_action(sprintf('wp_ajax_%s_thumbsup', static::TAXONOMY), array($this, 'actionLinkThumbsup'));

        add_action(sprintf('wp_ajax_nopriv_%s_thumbsup', static::TAXONOMY), array($this, 'actionLinkThumbsup'));

        add_action(sprintf('wp_ajax_%s_thumbsdown', static::TAXONOMY), array($this, 'actionLinkThumbsdown'));

        add_action(sprintf('wp_ajax_nopriv_%s_thumbsdown', static::TAXONOMY), array($this, 'actionLinkThumbsdown'));



        add_filter(sprintf('manage_edit-%s_columns', static::TAXONOMY), array($this, 'filterManageColumns'));

        add_filter(sprintf('manage_%s_custom_column', static::TAXONOMY), array($this, 'filterManageCustomColumn'), 10, 3);

        add_filter(sprintf('%s_row_actions', static::TAXONOMY), array($this, 'filterRowActions'), 10, 2);

        add_filter('get_terms_defaults', array($this, 'filterGetTermsDefaults'), 10, 2);

    }



    public function actionInit() {

        parent::actionInit();

        register_taxonomy(static::TAXONOMY, NULL, array(

            'show_ui'           => TRUE,

            'show_admin_column' => TRUE,

            'hierarchical'      => FALSE,

            'labels'            => array(

                'name'          => 'Links',

                'singular_name' => 'Link',

                'edit_item'     => 'Edit Link',

                'view_item'     => 'View Link',

                'update_item'   => 'Update Link',

                'add_new_item'  => 'Add New Custom Link',

                'search_items'  => 'Search Links',

                'not_found'     => 'No links found'

            )

        ));

        wp_register_script('cmlm-backend-link-taxonomy', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/link-taxonomy.js', array('jquery', 'common', 'inline-edit-tax'), App::version(), true);

        wp_register_style('cmlm-backend-bookmarklet', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/css/bookmarklet.css', array('cmlm-backend-admin'), App::version());

        wp_register_style('cmlm-file-icons', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/css/css-file-icons.css', array('cmlm-backend-admin'), time());



        // HTMLHelper::enqueueInputDateAssets();

    }



    public function actionAdminEnqueueScripts() {

        if (get_current_screen()->taxonomy == static::TAXONOMY) {

            wp_enqueue_style('cmlm-backend-admin');

            if (wp_script_is('inline-edit-tax', 'enqueued')) {

                wp_enqueue_script('cmlm-backend-link-taxonomy');

            }

            if (filter_input(INPUT_GET, 'source') === 'bookmarklet') {

                wp_enqueue_style('cmlm-backend-bookmarklet');

            }

        }

        wp_enqueue_style('cmlm-file-icons');

        wp_enqueue_media();

    }



    public function actionAdminMenu() {

        add_submenu_page(App::SLUG, 'Links', 'Links', 'manage_options', sprintf('edit-tags.php?taxonomy=%s', static::TAXONOMY));

    }



    public function actionAdminHead() {

        $screen = get_current_screen();

        if ($screen->taxonomy == static::TAXONOMY && $screen->base == 'edit-tags') {

            echo "<style>.form-field.term-slug-wrap{ display: none !important; }</style>\n";

        }

    }



    public function actionAddFormFields() {

        echo ViewHelper::load('views/backend/taxonomies/link/add_form_fields.php');

    }



    public function actionEditFormFields($term) {

        echo ViewHelper::load('views/backend/taxonomies/link/edit_form_fields.php', array(

            'category_id'   => get_term_meta($term->term_id, sprintf('%s_category', App::PREFIX), TRUE),

            'url'           => str_replace('​', '', get_term_meta($term->term_id, sprintf('%s_url', App::PREFIX), TRUE)),

            'tag_id_arr'    => get_term_meta($term->term_id, sprintf('%s_tag', App::PREFIX)),

            'subtitle'      => get_term_meta($term->term_id, sprintf('%s_subtitle', App::PREFIX), TRUE),

            'image_url'     => get_term_meta($term->term_id, sprintf('%s_image_url', App::PREFIX), TRUE),

            'video_url'     => get_term_meta($term->term_id, sprintf('%s_video_url', App::PREFIX), TRUE),

            'show_checkbox' => get_term_meta($term->term_id, sprintf('%s_show_checkbox', App::PREFIX), TRUE),

            'tagfile1_name' => get_term_meta($term->term_id, sprintf('%s_tagfile1_name', App::PREFIX), TRUE),

            'tagfile1_url'  => get_term_meta($term->term_id, sprintf('%s_tagfile1_url', App::PREFIX), TRUE),

            'tagfile2_name' => get_term_meta($term->term_id, sprintf('%s_tagfile2_name', App::PREFIX), TRUE),

            'tagfile2_url'  => get_term_meta($term->term_id, sprintf('%s_tagfile2_url', App::PREFIX), TRUE),

            'tagfile3_name' => get_term_meta($term->term_id, sprintf('%s_tagfile3_name', App::PREFIX), TRUE),

            'tagfile3_url'  => get_term_meta($term->term_id, sprintf('%s_tagfile3_url', App::PREFIX), TRUE),

            'date'          => get_term_meta($term->term_id, sprintf('%s_date', App::PREFIX), TRUE),
			//this price is to be shown in the edit form of the plugin
            'price'          => get_term_meta($term->term_id, sprintf('%s_price', App::PREFIX), TRUE),
            //this rank is to be shown in the edit form of the plugin
            'rank'          => get_term_meta($term->term_id, sprintf('%s_rank', App::PREFIX), TRUE)

        ));

    }



    public function actionEdited($term_id) {

        update_term_meta($term_id, sprintf('%s_edit_time', App::PREFIX), time());

        $key = sprintf('%s_category', App::PREFIX);



        // $value = filter_input( INPUT_POST, $key );

        $value = isset($_POST[$key]) ? $_POST[$key] : NULL;

        if ($value !== NULL) {

            $value = implode(',', $value);

            update_term_meta($term_id, $key, $value);

            if ($value === -1) {

                delete_term_meta($term_id, $key);

            }

        }
        //added rank to the foreach to see where this appears
        foreach (array('%s_url', '%s_subtitle', '%s_image_url', '%s_video_url', '%s_show_checkbox', '%s_tagfile1_url', '%s_tagfile1_name', '%s_tagfile2_url', '%s_tagfile2_name', '%s_tagfile3_url', '%s_tagfile3_name', '%s_date', '%s_rank', '%s_price') as $key) {

            $key = sprintf($key, App::PREFIX);

            $value = filter_input(INPUT_POST, $key);

            if ($key == sprintf('%s_url', App::PREFIX)) {

                $value = str_replace('�', '', $value);

                $value = str_replace('​', '', $value);

                $value = trim($value);

            }

            if ($key == sprintf('%s_date', App::PREFIX)) {

                $value = strtotime($value);

            }

            if ($value !== NULL) {

                update_term_meta($term_id, $key, $value);

            }

        };

        $key = sprintf('%s_tag', App::PREFIX);

        if (isset($_POST['tax_input']) && isset($_POST['tax_input'][$key]) && is_array($_POST['tax_input'][$key])) {

            $value = $_POST['tax_input'][$key];

            Misc::update_term_meta_array($term_id, $key, $value);

        } else {

            if (filter_input(INPUT_POST, 'action') == 'editedtag') {

                delete_term_meta($term_id, $key);

            }

        }

        if (Options::getOption('favicons_display') && Options::getOption('favicons_local_cache')) {

            $this->updateFavicon($term_id);

        }

    }



    public function actionCreate($term_id) {

        update_term_meta($term_id, sprintf('%s_create_time', App::PREFIX), time());

        return $this->actionEdited($term_id);

    }



    public function actionPreDeleteTerm($term_id, $taxonomy) {

        if ($taxonomy == static::TAXONOMY) {

            wp_delete_attachment(intval(get_term_meta($term_id, sprintf('%s_favicon_attachment', App::PREFIX), TRUE)));

        }

    }


    //adding rank to see is there is where it will apppear 
    public function filterManageColumns($columns) {

        unset($columns['posts']);

        //unset($columns['slug']);

        $columns[sprintf('%s_url', App::PREFIX)] = 'URL';

        //$columns[sprintf('%s_favicon_attachment', App::PREFIX)] = 'Favicon';

        $columns[sprintf('%s_category', App::PREFIX)] = 'Category';

        $columns[sprintf('%s_tag', App::PREFIX)] = 'Tags';

        $columns[sprintf('%s_date', App::PREFIX)] = 'Event Date';

        //$columns[sprintf('%s_date', App::PREFIX)] = 'Event Date';
        
		//this adds rank to the columns header piece now we are trying to find out where we get the rank to appear
        $columns[sprintf('%s_rank', App::PREFIX)] = 'Rank';
        
		//this adds Price to the columns header piece now we are trying to find out where we get the Price to appear
        $columns[sprintf('%s_price', App::PREFIX)] = 'Price';

       

        return $columns;

    }



    public function filterManageCustomColumn($out, $column_name, $term_id) {

        if ($column_name === sprintf('%s_url', App::PREFIX)) {

            $url = get_term_meta($term_id, $column_name, TRUE);

            if (!$url) {

                return;

            }

            $url_esc_html_split = Misc::invisibleChunkSplit(esc_html($url));

            if (Options::getOption('favicons_display')) {

                if (Options::getOption('favicons_local_cache')) {

                    $attach_id = get_term_meta($term_id, sprintf('%s_favicon_attachment', App::PREFIX), TRUE);

                    if (empty($attach_id)) {

                        $attach_id = $this->updateFavicon($term_id);

                    }

                    $attach_url = wp_get_attachment_url($attach_id);

                    return $attach_url ? sprintf('<img src="%s" alt="%s" class="cmlm-admin-link-icon" /> %s', $attach_url, esc_attr($url), $url_esc_html_split) : $url_esc_html_split;

                } else {

                    $img = sprintf('https://www.google.com/s2/favicons?domain_url=%s', urlencode($url));

                    return sprintf('<img src="%s" alt="%s" class="cmlm-admin-link-icon" /> %s', $img, esc_attr($url), $url_esc_html_split);

                }

            }

        }

        if ($column_name === sprintf('%s_category', App::PREFIX)) {

            $term_arr = array();

            $ids = get_term_meta($term_id, $column_name, TRUE);

            if (!empty($ids)) {

                $ids_arr = explode(',', $ids);

                foreach ($ids_arr as $id) {

                    $term = get_term_by('id', $id, CategoryTaxonomy::TAXONOMY);

                    if($term){

                        array_push($term_arr, $term->name);

                    }

                }

            }

            if (count($term_arr) > 0) {

                return implode(', ', $term_arr);

            }

            return;

        }

        if ($column_name === sprintf('%s_tag', App::PREFIX)) {

            $arr_id = get_term_meta($term_id, $column_name);

            if (!$arr_id) {

                return;

            }

            $items = get_terms(TagTaxonomy::TAXONOMY, array(

                'hide_empty'   => FALSE,

                'hierarchical' => FALSE,

                'include'      => implode(',', $arr_id)

            ));

            echo implode(', ', array_map(function($item) {

                        return $item->name;

                    }, $items));

        }

        if ($column_name === sprintf('%s_date', App::PREFIX)) {

            $ts = get_term_meta($term_id, $column_name, TRUE);

            $date = $ts ? date_i18n(App::getWpDateTimeFormat(), $ts, false) : false;

            return $date ? $date : false;

        }
		
		// getting the price column 
        if ($column_name === sprintf('%s_price', App::PREFIX)) {

            $price = get_term_meta($term_id, $column_name, TRUE);

            return $price;

        }

        if ($column_name === sprintf('%s_rank', App::PREFIX)) {

            $rank = get_term_meta($term_id, $column_name, TRUE);

            return $rank;

        }

    }



    public function actionEditTerms($term_id, $taxonomy) {

        if ($taxonomy === static::TAXONOMY) {

//            $key = sprintf('%s_url', App::PREFIX);

//            if (isset($_POST[$key]) && !strlen($_POST[$key])) {

//                if (defined('DOING_AJAX') && DOING_AJAX) {

//                    die('URL is required.');

//                } else {

//                    AdminNoticeManager::enqueue(new AdminNotice(uniqid(), 'error', 'URL is required.'));

//                    wp_redirect($_POST['_wp_http_referer']);

//                }

//                die();

//            }

            $key = sprintf('%s_category', App::PREFIX);

            if (isset($_POST[$key]) && intval($_POST[$key]) === -1) {

                AdminNoticeManager::enqueue(new AdminNotice(uniqid(), 'error', 'Category is required.'));

                wp_redirect($_POST['_wp_http_referer']);

                die();

            }

        }

    }



    public function filterGetTermsDefaults($defaults, $taxonomies) {

        $key = sprintf('%s_category', App::PREFIX);

        if ($taxonomies [0] == static::TAXONOMY && isset($_GET[$key])) {

            $id = intval($_GET[$key]);

            if ($id) {

                $defaults['meta_query'] = array(

                    array(

                        'key'     => sprintf('%s_category', App::PREFIX),

                        'value'   => App::$mysql_regexp_markers[0] . $id . App::$mysql_regexp_markers[1],

                        'compare' => 'REGEXP'

                    )

                );

            }

        }

        return $defaults;

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

        $key = sprintf('%s_url', App::PREFIX);

        if ($column_name == $key) {

            echo ViewHelper::load('views/backend/taxonomies/common/quick_edit_custom_box.php', array(

                'name'  => $column_name,

                'type'  => 'url',

                'title' => 'URL'

            ));

        }

    }



    public function actionAdminBarMenu($wp_admin_bar) {

        $args = array(

            'id'     => static::TAXONOMY,

            'parent' => 'new-content',

            'title'  => sprintf('%s Link', App::PLUGIN_NAME),

            'href'   => admin_url(sprintf('edit-tags.php?taxonomy=%s', static::TAXONOMY))

        );

        $wp_admin_bar->add_node($args);

    }



    private function updateFavicon($term_id) {

        $url = get_term_meta($term_id, sprintf('%s_url', App:: PREFIX), TRUE);

        if (!$url) {

            $url = 'localhost';

        }

        $tmpfile = download_url(sprintf('https://www.google.com/s2/favicons?domain_url=%s', urlencode($url)), 15);

        if (is_wp_error($tmpfile)) {

            AdminNoticeManager::enqueue(new AdminNoticeHelper(uniqid(), 'error', sprintf('Error occurred during favicon update: %s.', $tmpfile->get_error_message())));

            return;

        }

        wp_delete_attachment(intval(get_term_meta($term_id, sprintf('%s_favicon_attachment', App:: PREFIX), TRUE)));

        $wp_upload_dir = wp_upload_dir();

        $url = preg_replace('/^http(s?)/', '', $url);

        $filename = sanitize_file_name(sprintf('%s-%s-favicon.ico', App:: PREFIX, $url));

        $filename = $wp_upload_dir['path'] . '/' . $filename;

        rename($tmpfile, $filename);

        $filetype = wp_check_filetype(basename($filename), null);

        $attachment = array(

            'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),

            'post_mime_type' => $filetype['type'],

            'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),

            'post_content'   => '',

            'post_status'    => 'private'

        );

        $attach_id = wp_insert_attachment($attachment, $filename);

        $key = sprintf('%s_favicon_attachment', App::PREFIX);

        update_term_meta($term_id, $key, $attach_id);

        return $attach_id;

    }



    public static function wpListCategoriesArgs() {

        $link_order_by = Options::getOption('link_order_by');

        if (strpos($link_order_by, 'name') !== FALSE) {

            return array(

                'orderby' => 'name',

                'order'   => $link_order_by == 'name_asc' ? 'asc' : 'desc'

            );

        }

        if (strpos($link_order_by, 'edit_time') !== FALSE) {

            return array(

                'meta_key' => sprintf('%s_edit_time', App::PREFIX),

                'orderby'  => 'meta_value',

                'order'    => $link_order_by == 'edit_time_asc' ? 'asc' : 'desc'

            );

        }

        // customer sorting by event date

        $sort = array();

        if(isset($_GET[App::PREFIX . "_orderby"])){

            $sort =  array(

                'meta_key' => sanitize_text_field($_GET[App::PREFIX . "_orderby"]),

                'orderby'  => 'meta_value',

                'order'    => (isset($_GET[App::PREFIX . "_order"]) ? sanitize_text_field($_GET[App::PREFIX . "_order"]) : 'asc')

            );

        }

        return $sort;

    }



    public function actionLinkLiked() {

        $link_id = $_POST['link_id'];

        $ip_address = $_POST['ip_address'];



        if (!empty($link_id)) {



            $term_meta = add_term_meta($link_id, sprintf('%s_liked_ip', App::PREFIX), $ip_address);

            if ($term_meta) {

                $data = array(

                    'status' => true

                );

            } else {

                $data = array(

                    'status' => false,

                    'data'   => $term_meta

                );

            }

        }

        wp_send_json($data);

    }



    public static function canVoteOnLink($link_id) {

        $votes = isset($_COOKIE['cmlm_voted_links']) ? $_COOKIE['cmlm_voted_links'] : '';

        $votes_arr = explode(',', $votes);

        $result = !in_array($link_id, $votes_arr);

        return $result;

    }



    public static function setLinkVoted($link_id) {

        $votes = isset($_COOKIE['cmlm_voted_links']) ? $_COOKIE['cmlm_voted_links'] : '';

        $votes_arr = explode(',', $votes);

        $result = in_array($link_id, $votes_arr);

        if (!$result) {

            $votes_arr[] = $link_id;

        }

        setcookie('cmlm_voted_links', implode(',', $votes_arr), time() + 60 * 60 * 24, '/');

        return $result;

    }



    public function actionLinkThumbsup() {

        $link_id = $_POST['link_id'];

        $data = array(

            'status' => 0

        );

        if (!empty($link_id) && self::canVoteOnLink($link_id)) {

            $score = get_term_meta($link_id, sprintf('%s_linkscore', App::PREFIX), true);

            if ($score) {

                $score += 1;

            } else {

                $score = 1;

            }

            $result = update_term_meta($link_id, sprintf('%s_linkscore', App::PREFIX), $score);

            if ($result) {

                self::setLinkVoted($link_id);

                $data = array(

                    'status'   => 1,

                    'link_id'  => $link_id,

                    'newscore' => $score

                );

            }

        }

        wp_send_json($data);

    }



    public function actionLinkThumbsdown() {

        $link_id = $_POST['link_id'];

        $data = array(

            'status' => 0

        );

        if (!empty($link_id) && self::canVoteOnLink($link_id)) {

            $score = get_term_meta($link_id, sprintf('%s_linkscore', App::PREFIX), true);

            if ($score) {

                $score -= 1;

            } else {

                $score = 1;

            }

            $result = update_term_meta($link_id, sprintf('%s_linkscore', App::PREFIX), $score);

            if ($result) {

                self::setLinkVoted($link_id);

                $data = array(

                    'status'   => 1,

                    'link_id'  => $link_id,

                    'newscore' => $score

                );

            }

        }

        wp_send_json($data);

    }



    public static function clearCategories(array $categories) {

        if($categories){

            $link_terms = get_terms( array(

                'taxonomy'   => static::TAXONOMY,

                'hide_empty' => false,

                'meta_query' => array(

                'relation' => 'AND', 

                    array(

                        'key'     => CategoryTaxonomy::TAXONOMY,

                        'value'   => $categories,

                        'compare' => 'IN'

                    )

                )

            ) );



            // delete links

            foreach ( $link_terms as $term ) {

                wp_delete_term($term->term_id, static::TAXONOMY); 

            }

        }

    }



}

