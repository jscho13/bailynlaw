<?php

namespace com\cminds\listmanager\plugin\frontend\walkers;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;
use com\cminds\listmanager\plugin\frontend\walkers\LinkWalker;
use com\cminds\listmanager\plugin\options\Options;

class CategoryWalker extends \Walker_Category {

    private $max_links = 0;
    private $max_height = 0;
    private $show_title = TRUE;
    private $tag_term_id_arr = NULL;
    private $items_per_page = 0;
    private $arr_item_tax_total_gen = array();
    private $page_number = 1;
    private $max_page_number = 1;

    public function __construct($arr = array()) {
        if (isset($arr['max_links'])) {
            $this->max_links = $arr['max_links'];
        }
        if (isset($arr['max_height'])) {
            $this->max_height = $arr['max_height'];
        }
        if (isset($arr['show_title'])) {
            $this->show_title = $arr['show_title'];
        }
        if (isset($arr['tag_term_id_arr']) && is_array($arr['tag_term_id_arr']) && count(['tag_term_id_arr'])) {
            $this->tag_term_id_arr = $arr['tag_term_id_arr'];
        }
        if (isset($arr['items_per_page']) && $arr['items_per_page'] !== NULL && $arr['items_per_page'] != 0) {
            $this->items_per_page = $arr['items_per_page'];
        }
        if (isset($arr['arr_item_tax_total_gen']) && $arr['arr_item_tax_total_gen']) {
            $this->arr_item_tax_total_gen = $arr['arr_item_tax_total_gen'];
        }
        if (isset($arr['page_number']) && $arr['page_number']) {
            $this->page_number = $arr['page_number'];
        }
        if (isset($arr['max_page_number']) && $arr['max_page_number']) {
            $this->max_page_number = $arr['max_page_number'];
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<div class='children'>";
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "</div>";
    }

    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
        $bonus_style = '';
        if ($depth == 0) {
            $output .= '<div class="cmlm-category-box">';
            if ($this->max_height) {
                $bonus_style = sprintf('max-height: %spx;overflow-y: auto;', $this->max_height);
            }
        }
        $color = get_term_meta($category->term_id, sprintf('%s_bg_color', App::PREFIX), TRUE);
        $category_link = get_term_meta($category->term_id, sprintf('%s_category_link', App::PREFIX), TRUE);
        if ($color) {
            $output .= sprintf('<div class="cmlm-category" style="background: %s;%s" data-id="%s" data-role="category">', $color, $bonus_style, $category->term_id);
        } else {
            $output .= sprintf('<div class="cmlm-category" style="%s" data-id="%s" data-role="category">', $bonus_style, $category->term_id);
        }
        if ($this->show_title || $depth > 0) {
            if (current_user_can('manage_options')) {
                $editlink = sprintf('<a target="_blank" class="nostyling" href="%s">%s</s>', get_edit_term_link($category->term_id), '<span class="dashicons dashicons-admin-tools"></span>');
            } else {
                $editlink = '';
            }
            if (empty($category_link)) {
                $category_name = $category->name;
            } else {
                $category_name = sprintf('<div class="cmlm-header"><a class="cmlm-header-link" href="%s" target="_blank">%s</a>%s %s</div>', $category_link, $category->name, $editlink);
            }
            $output .= sprintf('<div class="cmlm-header"><span>%s</span> %s</div>', $category_name, $editlink);
        }

        // wp term order ugly hack
        $_get = $_GET;
        if (Options::getOption('link_order_by') != 'default') {
            $_GET['orderby'] = 1;
            $_GET['taxonomy'] = 1;
        }
        $meta_query = array(
            'relation' => 'AND',
            array(
                'key'     => sprintf('%s_category', App::PREFIX),
                'value'   => App::$mysql_regexp_markers[0] . $category->term_id . App::$mysql_regexp_markers[1],
                'compare' => 'REGEXP'
        ));
        if (is_array($this->tag_term_id_arr) && !empty($this->tag_term_id_arr[0])) {
            if (in_array(Options::getOption('new_tag_id'), $this->tag_term_id_arr)) {
                $meta_query = array_merge($meta_query, array(
                    array(
                        'relation' => 'OR',
                        array(
                            'key'     => sprintf('%s_tag', App::PREFIX),
                            'value'   => $this->tag_term_id_arr,
                            'compare' => 'IN'
                        ),
                        array(
                            'key'     => sprintf('%s_edit_time', App::PREFIX),
                            'value'   => time() - Options::getOption('new_tag_duration'),
                            'compare' => '>'
                        )
                    )
                ));
            } else {
                $meta_query = array_merge($meta_query, array(
                    array(
                        'relation' => 'OR',
                        array(
                            'key'     => sprintf('%s_tag', App::PREFIX),
                            'value'   => $this->tag_term_id_arr,
                            'compare' => 'IN'
                        )
                    )
                ));
            }
        }

        $offset = 0;
        $number = $this->max_links;
        /*
         * algorithm for getting the parameters of function wp_list_categories "offset" and "number"
         * if there are several pages of links
         * */
        if ($this->items_per_page && $this->max_page_number > 1) {
            // $this->arr_item_tax_total_gen;
            // $this->page_number;

            if ($this->page_number > 1) {
                for ($i = 0; $i < $this->page_number - 1; $i++) {
                    if (!isset($this->arr_item_tax_total_gen[$i][$category->term_id])) {
                        $this->arr_item_tax_total_gen[$i][$category->term_id] = 0;
                    }
                    $offset += (int) $this->arr_item_tax_total_gen[$i][$category->term_id];
                }
            }

            if (isset($this->arr_item_tax_total_gen[$this->page_number - 1][$category->term_id]) && !empty($this->arr_item_tax_total_gen[$this->page_number - 1][$category->term_id])) {
                $number = $this->arr_item_tax_total_gen[$this->page_number - 1][$category->term_id];
            } else {
                $offset = 9999;
                $number = 1;
            }

            $html = wp_list_categories(array_merge(array(
                'hide_empty'       => FALSE,
                'hierarchical'     => TRUE,
                'echo'             => FALSE,
                'title_li'         => NULL,
                'show_option_none' => NULL,
                'taxonomy'         => LinkTaxonomy::TAXONOMY,
                'walker'           => new LinkWalker(),
                'number'           => $number,
                'offset'           => $offset,
                'meta_query'       => $meta_query
                            ), LinkTaxonomy::wpListCategoriesArgs()));
        } else {
            $html = wp_list_categories(array_merge(array(
                'hide_empty'       => FALSE,
                'hierarchical'     => TRUE,
                'echo'             => FALSE,
                'title_li'         => NULL,
                'show_option_none' => NULL,
                'taxonomy'         => LinkTaxonomy::TAXONOMY,
                'walker'           => new LinkWalker(),
                'number'           => $number,
                'meta_query'       => $meta_query
                            ), LinkTaxonomy::wpListCategoriesArgs()));
        }

        if (Options::getOption('link_order_by') != 'default') {
            $_GET = $_get;
        }

        if ($html) {
            $output .= "<ul class='cmlm-category-link-list'>{$html}</ul>";
        }
    }

    public function end_el(&$output, $page, $depth = 0, $args = array()) {
        $output .= "</div>";
        if ($depth == 0) {
            $output .= "</div>";
        }
    }

    private function getRelatedLinkTaxID($category) {
        $terms = get_terms(LinkTaxonomy::TAXONOMY, array(
            'hide_empty' => FALSE,
            'meta_query' => array(
                array(
                    'key'     => sprintf('%s_category', App::PREFIX),
                    'value'   => $category->term_id,
                    'compare' => '='
                )
            )
        ));
        $term_id_arr = array_map(function($x) {
            return $x->term_id;
        }, (array) $terms);
        $term_id_arr[] = -1;
        return $term_id_arr;
    }

}
