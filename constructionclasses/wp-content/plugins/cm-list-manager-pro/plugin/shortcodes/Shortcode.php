<?php

namespace com\cminds\listmanager\plugin\shortcodes;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\helpers\ViewHelper;
use com\cminds\listmanager\plugin\taxonomies\ListTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;
use com\cminds\listmanager\plugin\options\Options;
use com\cminds\listmanager\plugin\misc\TermOrder;

class Shortcode {

    const SHORTCODE = 'cm_list_manager';
    const SHORTCODE_CCO = 'cmlm_for_constructionclassesorg';

    public function __construct() {
        add_action('init', array($this, 'actionInit'));
        add_action('init', array($this, 'actionAddShortcode'));
        add_action( 'wp_ajax_cmlm_category_pagination', array( $this, 'actionPageBtnClicked' ) );
        add_action( 'wp_ajax_nopriv_cmlm_category_pagination', array( $this, 'actionPageBtnClicked' ) );
        add_action( 'wp_ajax_cmlm_category_pagination_single', array( $this, 'actionPageBtnClickedSingle' ) );
        add_action( 'wp_ajax_nopriv_cmlm_category_pagination_single', array( $this, 'actionPageBtnClickedSingle' ) );
    }

    public function actionInit() {
        wp_register_script('masonry', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/masonry.pkgd.min.js', array('jquery'), '4.0.0');
        wp_register_script( 'masonry-image', plugin_dir_url( App::PLUGIN_FILE ) . 'assets/frontend/js/imagesloaded.pkgd.min.js', array( 'jquery' ), App::version() );
        wp_register_script('opentip', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/opentip-jquery.min.js', array('jquery'), App::version());
        wp_register_script('highlight', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/jquery.highlight.js', array('jquery'), App::version());
        wp_register_style('opentip', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/css/opentip.css', array(), App::version());
        wp_register_style('cmlm-frontend', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/css/frontend.css', array('opentip'), App::version());
        wp_register_style( 'cmlm-file-icons', plugin_dir_url( App::PLUGIN_FILE ) . 'assets/frontend/css/css-file-icons.css', array(), time() );
        wp_register_script('cmlm-frontend', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/frontend.js', array('jquery', 'masonry', 'masonry-image', 'opentip', 'highlight'), App::version());
        wp_localize_script('cmlm-frontend', 'cmlmOptions', array(
            'ajaxurl'                 => admin_url( 'admin-ajax.php' ),
            'items_per_page'                   => Options::getOption( 'items_per_page' ),
            'columnsCount'            => Options::getOption('columns_count'),
            'category_label'          => Options::getOption('cmlm_category_label'),
            'all_categories_label'    => Options::getOption('all_categories_label'),
            'tooltipBorderColor'      => Options::getOption('tooltip_border_color'),
            'user_display_categories' => Options::getOption('user_display_categories'),
            'tooltipBackgroundColor'  => Options::getOption('tooltip_background_color'),
        ));
    }

    public function actionAddShortcode() {
        if ($GLOBALS[sprintf('%s_isLicenseOk', App::SLUG)] || filter_input(INPUT_COOKIE, 'FOR_DEVELOPMENT_USE_ONLY_CMLM_PRO')) {
            add_shortcode(static::SHORTCODE, array($this, 'shortcode'));
            add_shortcode(static::SHORTCODE_CCO, array($this, 'shortcodeConstructionclassesorg'));
        }
    }

    public function shortcode($atts) {
        $atts = shortcode_atts(array(
            'list'              => NULL,
            'category'          => NULL,
            'tag'               => NULL,
            'category_id'       => NULL,
            'max_links'         => NULL,
            'max_height'        => NULL,
            'categories_filter' => '1',
            'placeholder'       => NULL,
            'description'       => NULL,
            'show_bonus_info'   => NULL,
            'items_per_page'    => NULL,
            'scroll'            => 0,
            'show_event_date'   => NULL,
           ), $atts);
        // extra shot
        if ($atts['category_id']) {
            return $this->renderSingle($atts);
        }
        // standard path
        // if (!strlen($atts['list']) && !strlen($atts['category']) && !strlen($atts['tag'])) {
            //return $this->error('list, category or tag attribute is required');
        // }

        $atts['list_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['list']), ListTaxonomy::TAXONOMY, 'list <code>%s</code> not found');
        if (is_wp_error($atts['list_term_id_arr'])) {
            return $this->error($atts['list_term_id_arr']->get_error_message());
        }
        $atts['category_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['category']), CategoryTaxonomy::TAXONOMY, 'category <code>%s</code> not found');
        if (is_wp_error($atts['category_term_id_arr'])) {
            return $this->error($atts['category_term_id_arr']->get_error_message());
        }
        $atts['tag_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['tag']), TagTaxonomy::TAXONOMY, 'tag <code>%s</code> not found');
        if (is_wp_error($atts['tag_term_id_arr'])) {
            return $this->error($atts['tag_term_id_arr']->get_error_message());
        }

        if (count($atts['list_term_id_arr']) == 0 &&
            count($atts['category_term_id_arr']) == 1 &&
            count($atts['tag_term_id_arr']) == 0) {
            return $this->renderSingle($atts);
        }
        if ( $atts['placeholder'] == NULL ) $atts['placeholder'] = Options::getOption('label_search_placeholder');

        return $this->render($atts);
    }

    public function shortcodeConstructionclassesorg($atts) {
        $atts = shortcode_atts(array(
            'list'              => NULL,
            'category'          => NULL,
            'tag'               => NULL,
            'category_id'       => NULL,
            'max_links'         => NULL,
            'max_height'        => NULL,
            'categories_filter' => '1',
            'placeholder'       => NULL,
            'description'       => NULL,
            'show_bonus_info'   => NULL,
            'items_per_page'    => NULL,
            'scroll'            => 0,
            'show_event_date'   => NULL,
           ), $atts);
        // extra shot
        if ($atts['category_id']) {
            return $this->renderSingle($atts);
        }
        // standard path
        // if (!strlen($atts['list']) && !strlen($atts['category']) && !strlen($atts['tag'])) {
            //return $this->error('list, category or tag attribute is required');
        // }

        $atts['list_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['list']), ListTaxonomy::TAXONOMY, 'list <code>%s</code> not found');
        if (is_wp_error($atts['list_term_id_arr'])) {
            return $this->error($atts['list_term_id_arr']->get_error_message());
        }
        $atts['category_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['category']), CategoryTaxonomy::TAXONOMY, 'category <code>%s</code> not found');
        if (is_wp_error($atts['category_term_id_arr'])) {
            return $this->error($atts['category_term_id_arr']->get_error_message());
        }
        $atts['tag_term_id_arr'] = $this->stringArrToTermIdArr(explode(',', $atts['tag']), TagTaxonomy::TAXONOMY, 'tag <code>%s</code> not found');
        if (is_wp_error($atts['tag_term_id_arr'])) {
            return $this->error($atts['tag_term_id_arr']->get_error_message());
        }

        if (count($atts['list_term_id_arr']) == 0 &&
            count($atts['category_term_id_arr']) == 1 &&
            count($atts['tag_term_id_arr']) == 0) {
            return $this->renderSingle($atts);
        }
        if ( $atts['placeholder'] == NULL ) $atts['placeholder'] = Options::getOption('label_search_placeholder');

        return $this->renderShortcodeConstructionclassesorg($atts);
    }

    private function stringArrToTermIdArr($slugs, $taxonomy, $error_format) {
        $arr = array();
        foreach ($slugs as $slug) {
            $slug = trim($slug);
            if (!strlen($slug)) {
                continue;
            }
            $res = get_term_by('slug', $slug, $taxonomy);
            if (!$res) {
                $res = get_term_by('name', $slug, $taxonomy);
            }
            if (!$res) {
                return new \WP_Error(1, sprintf($error_format, $slug));
            }
            $arr [] = $res->term_id;
        }
        return $arr;
    }

    private function renderSingle($atts) {
        if ($atts['category_id']) {
            $cat_term = get_term_by('term_id', $atts['category_id'], CategoryTaxonomy::TAXONOMY);
        } else {
            $cat_term = get_term_by('slug', $atts['category'], CategoryTaxonomy::TAXONOMY);
            if (!$cat_term) {
                $cat_term = get_term_by('name', $atts['category'], CategoryTaxonomy::TAXONOMY);
            }
        }
        if (!$cat_term) {
            return $this->error("category <code>{$atts['category']}</code> not found.");
        }

        TermOrder::init();

        wp_enqueue_style('cmlm-frontend');
        wp_enqueue_style('cmlm-file-icons');
        wp_enqueue_script('cmlm-frontend');

        wp_add_inline_style('cmlm-frontend', ViewHelper::load('views/frontend/shortcodes/inline_css.php'));

        return ViewHelper::load('views/frontend/shortcodes/shortcode2.php', array(
                    'category_term'   => $cat_term,
                    'max_links'       => $atts['max_links'],
                    'max_height'      => intval($atts['max_height']),
                    'show_bonus_info' => $atts['show_bonus_info'],
                    'items_per_page'  => $atts['items_per_page'],
        ));
    }

    private function render($atts) {

        TermOrder::init();

        wp_enqueue_style('cmlm-frontend');
        wp_enqueue_style('cmlm-file-icons');
        wp_enqueue_script('cmlm-frontend');

        wp_add_inline_style('cmlm-frontend', ViewHelper::load('views/frontend/shortcodes/inline_css.php'));

        return ViewHelper::load('views/frontend/shortcodes/shortcode.php', array(
                    'list_term_id_arr'     => $atts['list_term_id_arr'],
                    'category_term_id_arr' => $atts['category_term_id_arr'],
                    'tag_term_id_arr'      => $atts['tag_term_id_arr'],
                    'max_links'            => $atts['max_links'],
                    'max_height'           => intval($atts['max_height']),
                    'categories_filter'    => $atts['categories_filter'],
                    'placeholder'          => $atts['placeholder'],
                    'description'          => $atts['description'],
                    'show_bonus_info'      => $atts['show_bonus_info'],
                    'items_per_page'       => $atts['items_per_page'],
                    'scroll'               => $atts['scroll'],
                    'show_event_date'      => $atts['show_event_date'],
        ));
    }

    private function renderShortcodeConstructionclassesorg($atts) {

        TermOrder::init();

        wp_enqueue_style('cmlm-frontend');
        wp_enqueue_style('cmlm-file-icons');
        wp_enqueue_script('cmlm-frontend');

        wp_add_inline_style('cmlm-frontend', ViewHelper::load('views/frontend/shortcodes/inline_css_constructionclassesorg.php'));

        return ViewHelper::load('views/frontend/shortcodes/shortcode-constructionclassesorg.php', array(
                    'list_term_id_arr'     => $atts['list_term_id_arr'],
                    'category_term_id_arr' => $atts['category_term_id_arr'],
                    'tag_term_id_arr'      => $atts['tag_term_id_arr'],
                    'max_links'            => $atts['max_links'],
                    'max_height'           => intval($atts['max_height']),
                    'categories_filter'    => $atts['categories_filter'],
                    'placeholder'          => $atts['placeholder'],
                    'description'          => $atts['description'],
                    'show_bonus_info'      => $atts['show_bonus_info'],
                    'items_per_page'       => $atts['items_per_page'],
                    'scroll'               => $atts['scroll'],
                    'show_event_date'      => $atts['show_event_date'],
        ));
    }

    private function error($s) {
        return ViewHelper::load('views/frontend/shortcodes/error.php', array('message' => $s));
    }

    public function actionPageBtnClicked() {
        $page_number = $_POST['page_number'];
        $max_page_number = $_POST['max_page_number'];
        $max_height = $_POST['max_height'];
        $items_per_page = $_POST['items_per_page'];
        $category_term_id_arr = explode(',', $_POST['category_term_id_arr']);
        $list_term_id_arr = explode(',', $_POST['list_term_id_arr']);
        $tag_term_id_arr = explode(',', $_POST['tag_term_id_arr']);
        $max_links= $_POST['max_links'];

        if (!empty( $page_number )) {
			$html = ViewHelper::load( 'views/frontend/content_template.php', array(
            'page_number'           => $page_number,
            'items_per_page'        => $items_per_page,
            'max_links'             => $max_links,
            'max_page_number'       => $max_page_number,
            'max_height'            => $max_height,
            'category_term_id_arr'  => $category_term_id_arr,
            'tag_term_id_arr'       => $tag_term_id_arr,
            'list_term_id_arr'      => $list_term_id_arr
          ));
          $data = array(
            'result' => $html,
            'status' => 'multi'
          );
        }
        wp_send_json( $data );
        wp_die();
    }
    public function actionPageBtnClickedSingle() {
        $term_id = $_POST['term_id'];
        $page_number = $_POST['page_number'];
        $max_page_number = $_POST['max_page_number'];
        $max_height = $_POST['max_height'];
        $items_per_page = $_POST['items_per_page'];
        $max_links= $_POST['max_links'];

        if (!empty( $page_number )) {

          $html = ViewHelper::load( 'views/frontend/content_template2.php', array(
            'term_id'               => $term_id,
            'page_number'           => $page_number,
            'items_per_page'        => $items_per_page,
            'max_links'             => $max_links,
            'max_page_number'       => $max_page_number,
            'max_height'            => $max_height,
          ));
          $data = array(
              'result' => $html,
              'status' => 'single'
          );
        }
        wp_send_json( $data );
        wp_die();
    }

}
