<?php

namespace com\cminds\listmanager\plugin\services;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;

class ExportService {

    const NONCE = 'cmlm_export_service_nonce';
    const ACTION_GET_CSV = 'cmlm_export_service_get_csv';
    const CSV_FILENAME_DATE_TEMPLATE = '\C\M\_\C\u\r\a\t\e\d\_\L\i\s\t\_\M\a\n\a\g\e\r\_YmdHis\.\c\s\v';

    private static $_csv_header = 'category_link-slug_link-name_link-url_link-subtitle_link-description_tags_link-date';

    //private $_delimeter = ',';

    public function __construct() {
        add_action(sprintf('wp_ajax_%s', static::ACTION_GET_CSV), function() {
            if (is_admin() && wp_verify_nonce(filter_input(INPUT_POST, static::NONCE), static::NONCE)) {
                $this->init();
                $data = $this->getData();
                $data = $this->dataArrayToCSVArray($data);
                $this->sendCSV($data);
                wp_die();
            }
        });
    }

    private function init() {
//        $delimeter = filter_input(INPUT_POST, 'delimeter');
//        if (in_array($delimeter, array(',', ';'))) {
//            $this->_delimeter = $delimeter;
//        }
    }

    public function getData() {
        $items = get_terms(CategoryTaxonomy::TAXONOMY, array('hide_empty' => false, 'orderby' => 'name', 'hierarchical' => FALSE));
        foreach ($items as &$item) {
            $item->_links = $this->getLinksForCategory($item);
        }
        return $items;
    }

    private function getLinksForCategory($term) {
        $items = get_terms(LinkTaxonomy::TAXONOMY, array(
            'hide_empty' => false,
            'hierarchical' => FALSE,
            'orderby' => 'name',
            'meta_query' => array(
                array(
                    'key' => sprintf('%s_category', App::PREFIX),
                    'value' => App::$mysql_regexp_markers[0] . $term->term_id . App::$mysql_regexp_markers[1],
                    'compare' => 'REGEXP'
                )
            )
        ));
        foreach ($items as &$item) {
            $item->_url = get_term_meta($item->term_id, sprintf('%s_url', App::PREFIX), TRUE);
            $item->_subtitle = get_term_meta($item->term_id, sprintf('%s_subtitle', App::PREFIX), TRUE);
            $item->_tags = $this->getTagsForLink($item);
            $item->_date = get_term_meta($item->term_id, sprintf('%s_date', App::PREFIX), TRUE);
        }
        return $items;
    }

    private function getTagsForLink($term) {
        $arr = get_term_meta($term->term_id, sprintf('%s_tag', App::PREFIX));
        if (!is_array($arr) || count($arr) == 0) {
            return array();
        }
        return get_terms(TagTaxonomy::TAXONOMY, array(
            'hide_empty' => FALSE,
            'hierarchical' => FALSE,
            'orderby' => 'name',
            'include' => $arr
        ));
    }

    private function dataArrayToCSVArray($items) {
        $temp = new \SplTempFileObject();
        $data = array();
        foreach ($items as $category) {
            foreach ($category->_links as $link) {
                $link->_tags = array_map(function($x) {
                    return $x->name;
                }, $link->_tags);
                $temp->ftruncate(0);
                $temp->fputcsv($link->_tags, App::CSV_DELIMITER);
                $temp->rewind();
                $data [] = array(
                    $category->name,
                    $link->slug,
                    $link->name,
                    $link->_url,
                    $link->description,
                    $link->_subtitle,
                    trim($temp->current()),
                    $link->_date
                );
            }
        }
        return $data;
    }

    private function sendCSV($data) {
        $temp = new \SplTempFileObject();
        $temp->fputcsv(explode('_', static::$_csv_header), App::CSV_DELIMITER);
        foreach ($data as $row) {
            $temp->fputcsv($row, App::CSV_DELIMITER);
        }
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . date(static::CSV_FILENAME_DATE_TEMPLATE));
        $temp->rewind();
        $temp->fpassthru();
    }

}
