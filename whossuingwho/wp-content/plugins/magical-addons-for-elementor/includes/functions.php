<?php 
/*
* Magical addons functions 
*
*
*/


// include file
    require_once( MAGICAL_ADDON_PATH . '/includes/basic/style-script.php' );
    require_once( MAGICAL_ADDON_PATH . '/includes/basic/mg-admin-notice.php' );

function mg_get_allowed_html_tags() {
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
  
    return $allowed_html;
}

function mg_kses_tags( $string = '' ) {
    return wp_kses( $string, mg_get_allowed_html_tags() );
}
/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function mg_elementor_version_check( $operator = '<', $version = '2.6.0' ) {
    return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function mg_icons_render( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [] ) {
    // Check if its already migrated
    $migrated = isset( $settings['__fa4_migrated'][ $new_icon_id ] );
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty( $settings[ $old_icon_id ] );

    $attributes['aria-hidden'] = 'true';

    if ( mg_elementor_version_check( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
        \Elementor\Icons_Manager::render_icon( $settings[ $new_icon_id ], $attributes );
    } else {
        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $settings[ $old_icon_id ];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $settings[ $old_icon_id ];
            } else {
                $attributes['class'] .= ' ' . $settings[ $old_icon_id ];
            }
        }
        printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
    }
}

/*
 * Plugisn Options value
 * return on/off
 */
function mg_get_addons_option( $option, $default = '' ){
    $options = get_option( 'magical_addons' );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

/**
 *  Taxonomy List
 * @return array
 */
function mgaddons_taxonomy_list( $taxonomy = 'category' ){
    $terms = get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->slug ] = $term->name;
        }
        return $options;
    }
}


/**
 * Get Post List
 * return array
 */
function mgaddons_post_name( $post_type = 'post' ){
    $options = array();
    $options['0'] = __('Select','magical-addons-for-elementor');
   // $perpage = wooaddons_get_option( 'loadproductlimit', 'wooaddons_others_tabs', '20' );
    $all_post = array( 'posts_per_page' => -1, 'post_type'=> $post_type );
    $post_terms = get_posts( $all_post );
    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ){
        foreach ( $post_terms as $term ) {
            $options[ $term->ID ] = $term->post_title;
        }
        return $options;
    }
}

if ( ! function_exists( 'mgp_post_author' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function mgp_post_author() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( ' %s', 'post author', 'magical-addons-for-elementor' ),
            '<span class="mgp-author"><i class="fas fa-user"></i><a class="mgp-author-link ml-1" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo  $byline; // WPCS: XSS OK.

    }
endif;

function mg_plugin_homego($plugin){
        if('magical-addons-for-elementor' == $plugin  ){
            wp_redirect( admin_url( 'admin.php?page=magical-addons' ) );
            die();
        }
    }
add_action( 'activated_plugin', 'mg_plugin_homego' );



if ( ! function_exists( 'mg_plugin_comment_icon' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function mg_plugin_comment_icon() {
        if ( ! post_password_required() && ( comments_open() && get_comments_number() ) ) {
            echo '<span class="mgp-comment">';
            echo '<i class="fas fa-comment-alt"></i>';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( '<span class="screen-reader-text"> on %s</span>', 'xblog-pro' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            ,__('1 Comment','xblog-pro'),__('% Comments','xblog-pro'),'comments-link', ' ');
            echo '</span>';
        }

    }
endif;


 // Youtube video id filtring 
if ( ! function_exists( 'get_mg_youtube_id' ) ) :
function get_mg_youtube_id($url)
{
    $video_id = false;

    $url = parse_url($url);
    if (strcasecmp($url['host'], 'youtu.be') === 0)
    {
        #### (dontcare)://youtu.be/<video id>
        $video_id = substr($url['path'], 1);
    }
    elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
    {
        if (isset($url['query']))
        {
            parse_str($url['query'], $url['query']);
            if (isset($url['query']['v']))
            {
                #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                $video_id = $url['query']['v'];
            }
        }
        if ($video_id == false)
        {
            $url['path'] = explode('/', substr($url['path'], 1));
            if (in_array($url['path'][0], array('e', 'embed', 'v')))
            {
                #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                $video_id = $url['path'][1];
            }
        }
    }

    return $video_id;
}
endif;