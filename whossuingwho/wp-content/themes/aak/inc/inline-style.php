<?php
/**
 * Add inline css 
 *
 * 
 */
if ( ! function_exists( 'aak_inline_css' ) ) :
function aak_inline_css() {

  $style = '';

    //top bar settings  
  $aak_topbar_bg = get_theme_mod( 'aak_topbar_bg', '#343a40' );
  $aak_topbar_color = get_theme_mod( 'aak_topbar_color', '#fff' );
  $aak_topbar_hcolor = get_theme_mod( 'aak_topbar_hcolor', '#dedede' );
 
  if( $aak_topbar_bg != '#343a40' ){
    $style .='.aaktop-tophead.bg-dark{background-color:'.$aak_topbar_bg.'!important;}';
  }
  if( $aak_topbar_color != '#fff' ){
    $style .='.aaktop-tophead, .aaktop-tophead a, .aaktop-tophead span, .aaktop-tophead input{color:'.$aak_topbar_color.';}';
  }
  if( $aak_topbar_hcolor != '#dedede' ){
    $style .='.aaktop-tophead a:hover{color:'.$aak_topbar_hcolor.';}';
  }

// font settings
 $aak_body_fonts = get_theme_mod('aak_body_fonts','Poppins');
 $aak_font_size = get_theme_mod('aak_font_size','14');
 $aak_font_line_height = get_theme_mod('aak_font_line_height','24');
 $aak_head_fonts = get_theme_mod('aak_head_fonts','Lato');
 $aak_font_weight_head = get_theme_mod('aak_font_weight_head','700');

      if( $aak_body_fonts != 'Poppins'){
         $style .= 'body, p{font-family:\''.esc_attr($aak_body_fonts).'\', sans-serif;}';
       }
        if( $aak_font_size != '14'){
         $style .= 'body, p{font-size:'.esc_attr($aak_font_size).'px;}';
        }
        if( $aak_font_line_height != '24'){
         $style .= 'body, p{line-height:'.esc_attr($aak_font_line_height).'px;}';
        }

        if( $aak_head_fonts != 'Lato'){
         $style .= 'h1,h1 a, h2,h2 a, h3,h3 a, h4,h4 a, h5, h6{font-family:\''.esc_attr($aak_head_fonts).'\', sans-serif;}';
       }
        if( $aak_font_weight_head != '700'){
         $style .= 'h1, h2, h3, h4, h5, h6{font-weight:'.esc_attr($aak_font_weight_head).';}';
       }
    $aak_topfooter_bgcolor = get_theme_mod( 'aak_topfooter_bgcolor' );
    if( $aak_topfooter_bgcolor ){
          $style .='.footer-top.bg-dark{background:'.$aak_topfooter_bgcolor.'  !important;}';
        }
    $aak_tftitle_color = get_theme_mod( 'aak_tftitle_color' );
    if( $aak_tftitle_color ){
          $style .='.footer-widget .widget-title{color:'.$aak_tftitle_color.'  !important;}';
        }
    $aak_tftext_color = get_theme_mod( 'aak_tftext_color' );
    if( $aak_tftext_color ){
          $style .='.footer-widget, .footer-widget p, .footer-widget a, .footer-widget #wp-calendar caption, .footer-widget .search-form input.search-submit{color:'.$aak_tftext_color.'  !important;}';
        }
    $aak_tflink_hovercolor = get_theme_mod( 'aak_tflink_hovercolor' );
    if( $aak_tflink_hovercolor ){
          $style .='.footer-widget a:hover{color:'.$aak_tflink_hovercolor.'  !important;}';
        }
    $aak_footer_bgcolor = get_theme_mod( 'aak_footer_bgcolor' );
if( $aak_footer_bgcolor ){
      $style .='footer.site-footer{background:'.$aak_footer_bgcolor.'  !important;}';
    }
$aak_footer_color = get_theme_mod( 'aak_footer_color' );
if( $aak_footer_color ){
      $style .='footer.site-footer,footer.site-footer a,footer.site-footer p{color:'.$aak_footer_color.'  !important;}';
    }
$aak_footerlink_hcolor = get_theme_mod( 'aak_footerlink_hcolor' );
if( $aak_footerlink_hcolor ){
      $style .='footer.site-footer a:hover,footer.site-footer a:focus{color:'.$aak_footerlink_hcolor.'  !important;}';
    }





        wp_add_inline_style( 'aak-main', $style );
}
add_action( 'wp_enqueue_scripts', 'aak_inline_css' );
endif;
