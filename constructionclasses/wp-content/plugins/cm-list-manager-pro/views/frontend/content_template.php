<?php
use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\frontend\walkers\CategoryWalker;
use com\cminds\listmanager\plugin\frontend\walkers\TagWalker;
use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;
use com\cminds\listmanager\plugin\options\Options;

$meta_query = array('relation' => 'AND');
if (count($list_term_id_arr) && $list_term_id_arr[0]) {
    $meta_query = array_merge($meta_query, array(
        array(
            'key' => sprintf('%s_list', App::PREFIX),
            'value' => $list_term_id_arr,
            'compare' => 'IN'
        )
    ));
}

$cat_terms = get_terms(CategoryTaxonomy::TAXONOMY, array(
    'hide_empty' => FALSE,
    'include' => count($category_term_id_arr) ? $category_term_id_arr : NULL,
    'meta_query' => $meta_query
));

$cat_term_id_arr = array_map(function($x) {
    return $x->term_id;
}, (array) $cat_terms);
$cat_term_id_arr = array_filter($cat_term_id_arr, function($t_id) { return CategoryTaxonomy::isVisible($t_id);});

$cat_term_id_arr[] = -1;

// Pagination Starts
$max_links = intval($max_links);
if ( isset( $items_per_page ) && !empty( $items_per_page ) ) {

    global $wpdb;

    $all_links              = 0;
    $pagination_html        = '';
    $links_count_arr        = array();
    $arr_item_tax_total_gen = array();
    $category_taxonomy      = CategoryTaxonomy::TAXONOMY;
    $cat_term_id_arr_foreach = $cat_term_id_arr;

    $key_cat_term_id = array_search( -1, $cat_term_id_arr_foreach );
    if( !empty( $key_cat_term_id ) ) {
        unset( $cat_term_id_arr_foreach[$key_cat_term_id] );
    }

    foreach ( $cat_term_id_arr_foreach as $cat_term_id ) {
        $links_count = $wpdb->get_var(
            "SELECT COUNT(*)
                  FROM $wpdb->termmeta
                  WHERE meta_key = '{$category_taxonomy}'
                  AND meta_value REGEXP '{App::$mysql_regexp_markers[0]}{$cat_term_id}{App::$mysql_regexp_markers[1]}'");
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
                    continue;
                }
                $k++;
                if(count($links_count_arr_copy) != $k) {
                    $i++;
                }

            }
        }
        $arr_item_tax_total_gen[] = !empty($arr_item_tax_total) ? $arr_item_tax_total : array();
    }

    $count_cat_arr = count($cat_term_id_arr_foreach);
    if( $items_per_page && ($count_cat_arr * $max_links > $items_per_page|| $max_links == 0)) {
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
wp_list_categories(array(
		'style' => NULL,
		'hide_empty' => FALSE,
		'hierarchical' => TRUE,
		'title_li' => NULL,
		'show_option_all' => '',
		'include' => $cat_term_id_arr,
		'taxonomy' => CategoryTaxonomy::TAXONOMY,
		'walker' => new CategoryWalker(array(
				'max_links' => $max_links,
				'max_height' => $max_height,
				'tag_term_id_arr' => $tag_term_id_arr,
				'items_per_page' => $items_per_page,
				'arr_item_tax_total_gen' => $arr_item_tax_total_gen, // links quantity for each category
				'page_number'     => $page_number,
				'max_page_number'  =>  $max_page_number
				))
));

wp_list_categories(array(
		'style' => NULL,
		'hide_empty' => FALSE,
		'hierarchical' => FALSE,
		'title_li' => NULL,
		'show_option_none' => '',
		'show_option_all' => '',
		//'include' => count($tag_term_id_arr) ? $tag_term_id_arr : NULL,
		'taxonomy' => TagTaxonomy::TAXONOMY,
		'walker' => new TagWalker(array(
				'cat_term_id_arr' => $cat_term_id_arr,
				'tag_term_id_arr' => $tag_term_id_arr))
));
?>
