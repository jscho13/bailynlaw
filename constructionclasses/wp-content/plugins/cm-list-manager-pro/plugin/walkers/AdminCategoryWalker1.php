<?php

namespace com\cminds\listmanager\plugin\walkers;

class AdminCategoryWalker1 extends \Walker_Category {

    /**
     * Starts the element output.
     *
     * @since 2.1.0
     * @access public
     *
     * @see Walker::start_el()
     *
     * @param string $output   Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
        'list_cats', esc_attr( $category->name ), $category
        );

        // Don't generate an element if the category name is empty.
        if ( !$cat_name ) {
            return;
        }
        $link = '<a href="' . esc_url( get_edit_term_link( $category->term_id, $category->taxonomy ) ) . '" ';
        if ( $args[ 'use_desc_for_title' ] && !empty( $category->description ) ) {
            /**
             * Filter the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '>';
        $link .= $cat_name . '</a>';

        if ( !empty( $args[ 'feed_image' ] ) || !empty( $args[ 'feed' ] ) ) {
            $link .= ' ';

            if ( empty( $args[ 'feed_image' ] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args[ 'feed_type' ] ) ) . '"';

            if ( empty( $args[ 'feed' ] ) ) {
                $alt = ' alt="' . sprintf( __( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
            } else {
                $alt  = ' alt="' . sprintf( __( 'Feed for %s' ), $args[ 'feed' ] ) . '"';
                $name = $args[ 'feed' ];
                $link .= empty( $args[ 'title' ] ) ? '' : $args[ 'title' ];
            }

            $link .= '>';

            if ( empty( $args[ 'feed_image' ] ) ) {
                $link .= $name;
            } else {
                $link .= sprintf('<img src="%s" alt="%s" />', $args[ 'feed_image' ], $alt);
            }
            $link .= '</a>';

            if ( empty( $args[ 'feed_image' ] ) ) {
                $link .= ')';
            }
        }

        if ( !empty( $args[ 'show_count' ] ) ) {
            $link .= ' (' . number_format_i18n( $category->count ) . ')';
        }
        if ( 'list' == $args[ 'style' ] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );

            if ( !empty( $args[ 'current_category' ] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include'    => $args[ 'current_category' ],
                    'hide_empty' => false,
                ) );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] = 'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            /**
             * Filter the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

            $output .= ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args[ 'separator' ] ) ) {
            $output .= "\t$link" . $args[ 'separator' ] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

}