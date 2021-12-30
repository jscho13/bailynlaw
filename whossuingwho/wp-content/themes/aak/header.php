<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aak
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aak' ); ?></a>

	<?php 
	$aak_topbar_show = get_theme_mod( 'aak_topbar_show', 1 );

	if($aak_topbar_show){
		do_action( 'aak_header_top_display');
	}
		$aak_header_style = get_theme_mod( 'aak_header_style', 'style1');
	?>
	<header id="masthead" class="aak-header site-header <?php echo esc_attr($aak_header_style); ?>">

		<?php 
		if( $aak_header_style == 'style1'){
			do_action( 'aak_header_style_one' );
		}else{
			do_action( 'aak_header_style_two' );
		}



		 ?>



	</header><!-- #masthead -->