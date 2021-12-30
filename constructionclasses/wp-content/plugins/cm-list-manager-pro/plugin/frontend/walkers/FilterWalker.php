<?php
namespace com\cminds\listmanager\plugin\frontend\walkers;

use com\cminds\listmanager\plugin\options\Options;

class FilterWalker extends \Walker_Category {

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
		$links_count = count(get_terms([
						'taxonomy'=>'cmlm_link',
						'hide_empty' => false,
						'meta_key'=>'cmlm_category',
						'meta_value'=>$category->term_id]
					)
				);
		$title = '';
		if ( Options::getOption('show_tooltip_on_category') ) {
		$title = esc_attr($category->description) . " Use checkboxes to get the content from selected categories. Click on category, to show only related links";
		}
        $output .= sprintf('<li class="cmlm-filter-list-entry" title="%s" data-name="%s" data-id="%s" data-links-count="%d">', $title, esc_attr($category->name), $category->term_id, $links_count);
        if( Options::getOption('user_display_categories')) {
	        $output .= '<input type="checkbox" name="display_category[]" ' . checked( true, true, false ) . ' /> ';
        }
        $output .= $category->name;
    }

    public function end_el(&$output, $page, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

}
