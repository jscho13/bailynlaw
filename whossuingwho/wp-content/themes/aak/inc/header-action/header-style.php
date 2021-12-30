<?php
/**
 * header style action
 *
 * @link https://wpthemespace.com/product/beshop
 *
 * @package BeShop
 */

?>

<?php 
	function aak_main_menu_display(){
?>
		<div class="aakbar-item aak-main-nav pt-1 pb-1">
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="mshow"><?php esc_html_e( 'Menu', 'aak' ); ?></span><span class="mhide"><?php esc_html_e( 'Close Menu', 'aak' ); ?></span></button>
			<?php
		if ( has_nav_menu( 'menu-1' ) ) {

				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						//'fallback_cb'     => 'wp_page_menu',
						'walker'        => new Aak_Walker_Nav_Menu(),
					)
				);

		} elseif ( ! has_nav_menu( 'expanded' ) ) { ?>
				<ul id="primary-menu" class="menu nav-menu">
					<?php
						wp_list_pages(
									array(
							'match_menu_classes' => true,
							'show_sub_menu_icons' => true,
							'title_li' => false,
							'walker'   => new Aak_Walker_Page(),
						)
					);
					?>
				</ul>
		<?php

		}
							
	?>
			</nav><!-- #site-navigation -->
		</div>

<?php
	}
	add_action('aak_main_menu','aak_main_menu_display');

// create action for text and image logo for site
	function akk_logo_text_item(){

?>
	<div class="headerlogo-text">
		<?php the_custom_logo(); ?>
		<?php 
		if (display_header_text() == true || (display_header_text() == true && is_customize_preview()) ): 
				 ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
				$aak_description = get_bloginfo( 'description', 'display' );
				if ( $aak_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $aak_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>	
		<?php endif; ?>	
	</div>
<?php
	}
add_action('aak_logo_text','akk_logo_text_item');
 ?>






<?php 
	function aak_headerstyle_one_item(){
 
	$aak_menu_position = get_theme_mod( 'aak_menu_position','right' );
	$aak_logo_position = get_theme_mod( 'aak_logo_position', 'left' );
	$aak_dheader_text = get_theme_mod( 'display_header_text', 1 );
?>
	<?php if(has_header_image()): ?>
		<div class="aak-header-img">
				<?php the_header_image_tag(); ?>
		</div>
	<?php endif; ?>
	<div class="brand-menubar aakmstyle1">
		<div class="container">
			<div class="d-flex aak-menu-wrap aak-logo-<?php echo esc_attr($aak_logo_position); ?>">
				<div class="aakbar-item site-branding">
					<?php do_action('aak_logo_text'); ?>
				</div><!-- .site-branding -->
				<div class="aak-main-menu flex-grow-1 menu-<?php echo esc_attr($aak_menu_position); ?>">
					<?php do_action( 'aak_main_menu' ); ?>
				</div>
			</div>
		</div>
	</div><!-- #brand menu bar -->

<?php
}
add_action('aak_header_style_one','aak_headerstyle_one_item');

	function aak_headerstyle_two_item(){

	$aak_menu_position = get_theme_mod( 'aak_menu_position','center' );
	$aak_logo_position = get_theme_mod( 'aak_logo_position', 'center' );
?>

		<?php 
		$aak_dheader_text = get_theme_mod( 'display_header_text', 1 );
		 ?>
		<?php if(has_header_image()): ?>
		<div class="site-branding has-himg text-center <?php if($aak_dheader_text && has_custom_logo()): ?>aak-two-logo<?php endif; ?>">
			<div class="aak-header-img">
				<?php the_header_image_tag(); ?>
			</div>
		<?php else: ?>
			<div class="site-branding text-center <?php if($aak_dheader_text && has_custom_logo()): ?>aak-two-logo<?php endif; ?>">
		<?php endif; ?>
		<div class="aakbar-item site-branding mr-lg-auto flex-grow-1">
			<div class="headerlogo-text htl-<?php echo esc_attr($aak_logo_position); ?>">
			<div class="aak-header-titem pt-2">
				<?php the_custom_logo(); ?>
			<?php 
		if (display_header_text() == true || (display_header_text() == true && is_customize_preview()) ): 
				 ?>	
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
				$aak_description = get_bloginfo( 'description', 'display' );
				if ( $aak_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $aak_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>	
			<?php endif; ?>	
			</div>
			</div>
		</div><!-- .site-branding -->
		</div>
		<div class="brand-menubar">
			<div class="container">
				<div class="aakmenu-display aadhs-two">
					<div class="aak-menu-main menu-<?php echo esc_attr($aak_menu_position); ?>">
						<?php do_action( 'aak_main_menu' ); ?>
					</div>
				</div>
			</div>
		</div>
		</div><!-- #brand menu bar -->


<?php
	}
	add_action('aak_header_style_two','aak_headerstyle_two_item');


 ?>