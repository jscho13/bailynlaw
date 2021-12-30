<?php

namespace com\cminds\listmanager\plugin\frontend\walkers;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;
use com\cminds\listmanager\plugin\frontend\walkers\LinkWalker;
use com\cminds\listmanager\plugin\options\Options;

class TagWalker extends \Walker_Category {

    private $cat_term_id_arr = array();
    private $tag_term_id_arr = array();

    public function __construct($arr) {
        $this->cat_term_id_arr = $arr;
        if (isset($arr['cat_term_id_arr']) && is_array($arr['cat_term_id_arr']) && count($arr['cat_term_id_arr'])) {
            $this->cat_term_id_arr = $arr['cat_term_id_arr'];
        }
        if (isset($arr['tag_term_id_arr']) && is_array($arr['tag_term_id_arr']) && count($arr['tag_term_id_arr'])) {
            $this->tag_term_id_arr = $arr['tag_term_id_arr'];
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<div class='children'>";
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "</div>";
    }

    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
        if ($depth == 0) {
            $output .= '<div class="cmlm-category-box">';
        }

        $output .= sprintf('<div class="cmlm-category cmlm-hidden" style="display:none" data-id="%s" data-role="tag">', $category->term_id);

        $color = get_term_meta($category->term_id, sprintf('%s_color', App::PREFIX), TRUE);
        if ($color) {
            $output .= sprintf('<div class="cmlm-header"><span style="background:%s;color:#fff;padding:0 5px;">%s</span></div>', $color, $category->name);
        } else {
            $output .= sprintf('<div class="cmlm-header">%s</div>', $category->name);
        }

        // wp term order ugly hack
        $_get = $_GET;
        if (Options::getOption('link_order_by') != 'default') {
            $_GET['orderby'] = 1;
            $_GET['taxonomy'] = 1;
        }

        $html = wp_list_categories(array_merge(array(
            'hide_empty' => FALSE,
            'hierarchical' => TRUE,
            'echo' => FALSE,
            //'include' => $this->getRelatedLinkTaxID($category),
            'title_li' => NULL,
            'show_option_none' => NULL,
            'taxonomy' => LinkTaxonomy::TAXONOMY,
            'walker' => new LinkWalker(array('show_tags' => FALSE)),
            'meta_query' => $this->getRelatedLinkTaxMetaQuery($category)), LinkTaxonomy::wpListCategoriesArgs()));

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

    private function getRelatedLinkTaxMetaQuery($category) {
        $meta_query = array(
            'relation' => 'AND',
            array(
                'key' => sprintf('%s_tag', App::PREFIX),
                'value' => $category->term_id,
                'compare' => '='
            ),
            array(
                'key' => sprintf('%s_category', App::PREFIX),
                'value' => $this->cat_term_id_arr,
                'compare' => 'IN'
            )
        );
        if (Options::getOption('new_tag_id') == $category->term_id) {
            $meta_query = array(
                'relation' => 'AND',
                array(
                    'relation' => 'OR',
                    array(
                        'key' => sprintf('%s_tag', App::PREFIX),
                        'value' => $category->term_id,
                        'compare' => '='
                    ),
                    array(
                        'key' => sprintf('%s_edit_time', App::PREFIX),
                        'value' => time() - Options::getOption('new_tag_duration'),
                        'compare' => '>'
                    )
                ),
                array(
                    'key' => sprintf('%s_category', App::PREFIX),
                    'value' => $this->cat_term_id_arr,
                    'compare' => 'IN'
                )
            );
        }
        if ($this->tag_term_id_arr) {
            if (in_array(Options::getOption('new_tag_id'), $this->tag_term_id_arr)) {
                $meta_query = array_merge($meta_query, array(
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => sprintf('%s_tag', App::PREFIX),
                            'value' => $this->tag_term_id_arr,
                            'compare' => 'IN'
                        ),
                        array(
                            'key' => sprintf('%s_edit_time', App::PREFIX),
                            'value' => time() - Options::getOption('new_tag_duration'),
                            'compare' => '>'
                        )
                    )
                ));
            } else {
                $meta_query = array_merge($meta_query, array(
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => sprintf('%s_tag', App::PREFIX),
                            'value' => $this->tag_term_id_arr,
                            'compare' => 'IN'
                        )
                    )
                ));
            }
        }
        $meta_query = array(
            'relation' => 'OR',
            $meta_query
        );
        return $meta_query;
    }

    private function getRelatedLinkTaxID($category) {
        $meta_query = array(
            'relation' => 'OR',
            array(
                'relation' => 'AND',
                array(
                    'key' => sprintf('%s_tag', App::PREFIX),
                    'value' => $category->term_id,
                    'compare' => '='
                ),
                array(
                    'key' => sprintf('%s_category', App::PREFIX),
                    'value' => $this->cat_term_id_arr,
                    'compare' => 'IN'
                )
            )
        );
        if (Options::getOption('new_tag_id') == $category->term_id) {
            $meta_query = array_merge($meta_query, array(
                array(
                    'relation' => 'AND',
                    array(
                        'key' => sprintf('%s_edit_time', App::PREFIX),
                        'value' => time() - Options::getOption('new_tag_duration'),
                        'compare' => '>'
                    ),
                    array(
                        'key' => sprintf('%s_category', App::PREFIX),
                        'value' => $this->cat_term_id_arr,
                        'compare' => 'IN'
                    )
                )
            ));
        }
        $terms = get_terms(LinkTaxonomy::TAXONOMY, array(
            'hide_empty' => FALSE,
            'meta_query' => $meta_query
        ));
        $term_id_arr = array_map(function($x) {
            return $x->term_id;
        }, (array) $terms);
        $term_id_arr[] = -1;
        return $term_id_arr;
    }

}
