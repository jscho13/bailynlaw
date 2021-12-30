<?php

namespace com\cminds\listmanager\plugin\services;

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;
use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;

class CategoryImportService {

    const NONCE = 'cmlm_category_import_service_nonce';
	const CATEGORY_TAXONOMY = 'category';
    const ACTION_CAT_IMPORT = 'cmlm_category_import_service';
    const IMPORT_POSTS = 'import_posts';

	private $blog_categories = array();
	private $cat_counter = 0;
	private $link_counter = 0;
    public function __construct() {}

    private function getBlogCategories() {
        $this->blog_categories = get_terms(static::CATEGORY_TAXONOMY, array('hide_empty' => false, 'orderby' => 'name', 'hierarchical' => FALSE));
		return $this->blog_categories;
    }
	
	private function getBlogPosts($category_id) {
		$posts = get_posts(array(
            'numberposts' => -1,
            'category' => $category_id
        ));
		return $posts;
	}

    private function setCmlmLink($post) {
        $link = get_permalink($post->ID);
        $slug = $post->post_name;
        $title = $post->post_title;
        $blog_cats = get_the_category($post->ID);
        
        $term = get_term_by('slug', $slug, LinkTaxonomy::TAXONOMY);
        if (is_wp_error($term) || $term) return TRUE;
        
        $res = wp_insert_term(wp_unique_term_slug($slug, (object) array('taxonomy' => LinkTaxonomy::TAXONOMY)), LinkTaxonomy::TAXONOMY);
        
        if (is_wp_error($res)) return FALSE;
        
        $term = get_term_by('id', $res['term_id'], LinkTaxonomy::TAXONOMY);

        if (is_wp_error($term)) return FALSE;

        wp_update_term($term->term_id, LinkTaxonomy::TAXONOMY, array(
                'name' => $title,
                'slug' => $slug
            ));
        foreach($blog_cats as $cat) {
            $cmlm_cat = get_term_by('slug', $cat->slug, sprintf('%s_category', App::PREFIX));
            if ($cmlm_cat) {
                update_term_meta($term->term_id, sprintf('%s_category', App::PREFIX), $cmlm_cat->term_id);
            }
        }
        update_term_meta($term->term_id, sprintf('%s_url', App::PREFIX), $link);
        
        return $this->link_counter++ && TRUE;
    }
    
    private function importLinks($posts) {
        $post_links = array();
        
        foreach($posts as $post) {
            $link = get_permalink($post->ID);
            if (!in_array($link, $post_links)) {
                $post_links[] = $link;
                $this->setCmlmLink($post);
            } else {
                continue;
            }
        };
    }
    private function setCmlmCategory($category) {
        $name = $category->name;
        if (!strlen($name)) {
            return FALSE;
        }
        $res = term_exists($name, CategoryTaxonomy::TAXONOMY);
		if ($res === 0 || $res === NULL) {
			$res = wp_insert_term($name, CategoryTaxonomy::TAXONOMY, array(
					'description' => $category->description,
					'parent'      => 0,
					'slug'        => $category->slug,
				)
			);
            if (is_wp_error($res)) {
                if (static::DEBUG) {
                    wp_die(join('<br />', array($res->get_error_message(), __METHOD__, __LINE__)), NULL);
                }
                return FALSE;
            } else {
				$this->cat_counter++;
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

	public function import($import_posts) {
		$this->getBlogCategories();
		foreach($this->blog_categories as $blog_cat) {
			$this->setCmlmCategory($blog_cat);
		}
        if ($import_posts) {
            foreach($this->blog_categories as $blog_cat) {
				$posts = $this->getBlogPosts($blog_cat->term_id);
                $this->importLinks($posts);
			}
		}
		return array($this->cat_counter, $this->link_counter);
	}
}
