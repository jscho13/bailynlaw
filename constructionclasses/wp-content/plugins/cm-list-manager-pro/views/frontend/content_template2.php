<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\frontend\walkers\FilterWalker;
use com\cminds\listmanager\plugin\frontend\walkers\CategoryWalker;
use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;
use com\cminds\listmanager\plugin\options\Options;

$cat_terms = get_terms(CategoryTaxonomy::TAXONOMY, array(
    'hide_empty' => FALSE,
    'child_of' => $term_id
));

$cat_term_id_arr = array_map(function($x) {
    return $x->term_id;
}, (array) $cat_terms);
$cat_term_id_arr[] = $term_id;
$cat_term_id_arr = array_filter($cat_term_id_arr, function($t_id) { return CategoryTaxonomy::isVisible($t_id);});

?>

<?php
// Pagination Starts
$max_links = intval($max_links);
if ( isset( $items_per_page ) && !empty( $items_per_page ) ) {
    $pagination_html = '';
    $cat_term_id_arr_foreach = $cat_term_id_arr;

    $key_cat_term_id = array_search( -1, $cat_term_id_arr_foreach );
    if( !empty( $key_cat_term_id ) ) {
        unset( $cat_term_id_arr_foreach[$key_cat_term_id] );
    }
    // links quantity for each category
    global $wpdb;
    $category_taxonomy = CategoryTaxonomy::TAXONOMY;
    $all_links = 0;
    foreach ( $cat_term_id_arr_foreach as $cat_term_id ) {
        $links_count = $wpdb->get_var(
                        "SELECT COUNT(*)
                        FROM $wpdb->termmeta
                        WHERE meta_key = '{$category_taxonomy}'
                        AND meta_value
                        REGEXP '{App::$mysql_regexp_markers[0]}{$cat_term_id}{App::$mysql_regexp_markers[1]}'");
        if( $links_count > 0 ) {
            if( $links_count > $max_links && $max_links > 0 ) {
                $links_count = $max_links;
            }
            $links_count_arr[$cat_term_id] = $links_count;
        }
        $all_links += $links_count;
    }

    // getting a links distribution array on pages
    $links_count_arr_copy = $links_count_arr;
    while (!empty($links_count_arr_copy)) {
        $j = 0;
        $arr_item_tax_total = array_map(function(){return 0;}, $links_count_arr_copy);

        for ($i=0; $i < $items_per_page; $i++) {
            $k = 0;
            foreach ($links_count_arr_copy as $key => $value) {
                if($i >= $items_per_page) break;
                if($j > 2*$items_per_page) break;
                if( $value > 0) {
                    $links_count_arr_copy[$key] = $value - 1;
                    $arr_item_tax_total[$key] += 1;
                } else {
                    $j++;
                    unset($links_count_arr_copy[$key]);
                    $correct_array = $key;
                    continue;
                }
                $k++;
                if(count($links_count_arr_copy) != $k) {
                    $i++;
                }

            }

        }

        if(!empty($arr_item_tax_total)) $arr_item_tax_total_gen[] = $arr_item_tax_total;
    }

    // getting max_number_pages
    if( $items_per_page && (count($cat_term_id_arr_foreach)*$max_links > $items_per_page || $max_links == 0)) {
        $max_page_number = ceil(array_sum($links_count_arr) / $items_per_page);
    } else {
        $max_page_number = 1;
    }
    if( $page_number > $max_page_number ) $page_number = $max_page_number;
}
?>
<div class="cmlm-grid-sizer"></div>
<div class="cmlm-gutter-sizer"></div>

<?php

$paginationData = array();
if ( isset( $page_number ) ) {
    $paginationData = array(
      'items_per_page' => $items_per_page,
      'arr_item_tax_total_gen' => $arr_item_tax_total_gen,
      'page_number'     => $page_number,
      'max_page_number'  =>  $max_page_number
    );
}
wp_list_categories(array(
    'style' => NULL,
    'hide_empty' => FALSE,
    'hierarchical' => TRUE,
    'title_li' => NULL,
    'show_option_all' => '',
    'include' => $cat_term_id_arr,
    'taxonomy' => CategoryTaxonomy::TAXONOMY,
    'walker' => new CategoryWalker(array_merge(array(
        'max_links' => $max_links,
        'max_height' => $max_height,
        'show_title' => FALSE), $paginationData)
    )
));
?>
<?php if( isset( $pagination_html ) ) echo $pagination_html; ?>
