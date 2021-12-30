<?php



namespace com\cminds\listmanager\plugin\services;



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;

use com\cminds\listmanager\plugin\misc\Misc;



class ImportService {



    const COL_IDX_CATEGORY_NAME = 0;

    const COL_IDX_LINK_SLUG = 1;

    const COL_IDX_LINK_NAME = 2;

    const COL_IDX_LINK_URL = 3;

    const COL_IDX_LINK_SUBTITLE = 4;

    const COL_IDX_LINK_DESCRIPTION = 5;

    const COL_IDX_TAG_NAMES = 6;

    const COL_IDX_LINK_DATE = 7;
    //adding in rank for import
    const COL_IDX_LINK_RANK = 8;
    //adding in rank for import
    const COL_IDX_LINK_PRICE = 9;

    const DEBUG = FALSE;



    private $_rows = array();



    public function __construct() {

        

    }



    public function processFile($filename) {

        if (file_exists($filename)) {

            $file = new \SplFileObject($filename);

            while (!$file->eof()) {

                $arr = $file->fgetcsv(App::CSV_DELIMITER);

                if ($arr != array(NULL)) {

                    $this->_rows [] = $arr;

                }

            }

        }

        return $this;

    }



    public function skipHeader($isSkipHeader = false) {

        if ($isSkipHeader) {

            unset($this->_rows[0]);

        }

        return $this;

    }



    public function clearLinkFromLists(array $lists) {

        if ($lists) {

            $categories = CategoryTaxonomy::clearLists($lists);

            if($categories){

                LinkTaxonomy::clearCategories($categories);

            }

        }

        return $this;

    }



    public function import() {

        foreach ($this->_rows as $row) {

            $category = $this->rowToCategory($row);

            $tag_id_arr = $this->rowToTags($row);

            $link = $this->rowToLink($row);

            if (!$link) {

                continue;

            }

            wp_update_term($link->term_id, LinkTaxonomy::TAXONOMY, array(

                'name' => $row[static::COL_IDX_LINK_NAME],

                'description' => $row[static::COL_IDX_LINK_DESCRIPTION]

            ));

            if ($category) {

                update_term_meta($link->term_id, sprintf('%s_category', App::PREFIX), $category->term_id);

                // attach to list

                $key = sprintf('%s_list', App::PREFIX);

                if (isset($_POST['tax_input']) && isset($_POST['tax_input'][$key]) && is_array($_POST['tax_input'][$key])) {

                    $value = $_POST['tax_input'][$key];

                    Misc::update_term_meta_array($link->term_id, $key, $value);

                }

            }

            update_term_meta($link->term_id, sprintf('%s_url', App::PREFIX), $row[static::COL_IDX_LINK_URL]);

            update_term_meta($link->term_id, sprintf('%s_subtitle', App::PREFIX), $row[static::COL_IDX_LINK_SUBTITLE]);

            //Adding in rank to import
            update_term_meta($link->term_id, sprintf('%s_rank', App::PREFIX), $row[static::COL_IDX_LINK_RANK]);
			
			//Adding in price to import
            update_term_meta($link->term_id, sprintf('%s_price', App::PREFIX), $row[static::COL_IDX_LINK_PRICE]);


            $ar = explode("@", $row[static::COL_IDX_LINK_DATE]);

            $date_str = isset($ar[0]) ? $ar[0] : $row[static::COL_IDX_LINK_DATE];

            $ts = strtotime( $date_str );

            if($ts){

                update_term_meta($link->term_id, sprintf('%s_date', App::PREFIX), $ts);

            }



            Misc::update_term_meta_array($link->term_id, sprintf('%s_tag', App::PREFIX), $tag_id_arr);

        }

    }



    private function rowToCategory($row) {

        $name = trim($row[static::COL_IDX_CATEGORY_NAME]);

        if (!strlen($name)) {

            return FALSE;

        }

        $res = term_exists($name, CategoryTaxonomy::TAXONOMY);

        if ($res === 0 || $res === NULL) {

            $res = wp_insert_term($name, CategoryTaxonomy::TAXONOMY);

            if (is_wp_error($res)) {

                if (static::DEBUG) {

                    wp_die(join('<br />', array($res->get_error_message(), __METHOD__, __LINE__)), NULL);

                }

                return FALSE;

            }

        }

        $term = get_term_by('id', $res['term_id'], CategoryTaxonomy::TAXONOMY);

        if (is_wp_error($term)) {

            if (static::DEBUG) {

                wp_die(join('<br />', array($term->get_error_message(), __METHOD__, __LINE__)), NULL);

            }

            return FALSE;

        }

        return $term;

    }



    private function rowToTags($row) {

        if (!strlen($row[static::COL_IDX_TAG_NAMES])) {

            return array();

        }

        $arr = array();

        $items = str_getcsv($row[static::COL_IDX_TAG_NAMES]);

        foreach ($items as $item) {

            if (strlen($item)) {

                $term = $this->strToTag($item);

                if (!$term) {

                    continue;

                }

                $arr[] = $term->term_id;

            }

        }

        return $arr;

    }



    private function strToTag($name) {

        $name = trim($name);

        $res = term_exists($name, TagTaxonomy::TAXONOMY);

        if ($res === 0 || $res === NULL) {

            $res = wp_insert_term($name, TagTaxonomy::TAXONOMY);

            if (is_wp_error($res)) {

                if (static::DEBUG) {

                    wp_die(join('<br />', array($res->get_error_message(), __METHOD__, __LINE__)), NULL);

                }

                return FALSE;

            }

        }

        $term = get_term_by('id', $res['term_id'], TagTaxonomy::TAXONOMY);

        if (is_wp_error($term)) {

            if (static::DEBUG) {

                wp_die(join('<br />', array($term->get_error_message(), __METHOD__, __LINE__)), NULL);

            }

            return FALSE;

        }

        return $term;

    }



    private function rowToLink($row) {

        if (!strlen(sanitize_title($row[static::COL_IDX_LINK_NAME]))) {

            return FALSE;

        }

        $term = get_term_by('slug', trim($row[static::COL_IDX_LINK_SLUG]), LinkTaxonomy::TAXONOMY);

        if (is_wp_error($term)) {

            if (static::DEBUG) {

                wp_die(join('<br />', array($term->get_error_message(), __METHOD__, __LINE__)), NULL);

            }

            return FALSE;

        }

        if ($term) {

            return $term;

        }

        $res = wp_insert_term(wp_unique_term_slug(sanitize_title($row[static::COL_IDX_LINK_NAME]), (object) array('taxonomy' => LinkTaxonomy::TAXONOMY)), LinkTaxonomy::TAXONOMY);

        if (is_wp_error($res)) {

            if (static::DEBUG) {

                wp_die(join('<br />', array($res->get_error_message(), __METHOD__, __LINE__)), NULL);

            }

            return FALSE;

        }

        $term = get_term_by('id', $res['term_id'], LinkTaxonomy::TAXONOMY);

        if (is_wp_error($term)) {

            if (static::DEBUG) {

                wp_die(join('<br />', array($term->get_error_message(), __METHOD__, __LINE__)), NULL);

            }

            return FALSE;

        }

        return $term;

    }



}

