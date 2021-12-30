<?php
/**
 * Template part for displaying header top bar
 *
 * @link https://wpthemespace.com/product/beshop
 *
 * @package BeShop
 */

?>

<?php 
 function aak_header_top_display_item(){
 	$aak_topbar_mtext = get_theme_mod( 'aak_topbar_mtext', esc_html__('Welcome to Our Website','aak') );
	$aak_topbar_menushow = get_theme_mod( 'aak_topbar_menushow',1 );
	$aak_topbar_search = get_theme_mod( 'aak_topbar_search',1 );
 ?>
 	<div class="aaktop-tophead bg-dark text-light pt-1 pb-1">
	<div class="container">
			<div class="row">
			<?php if($aak_topbar_mtext): ?>
				<div class="col-md-auto">
					<span class="bhtop-text pt-2"><?php echo esc_html($aak_topbar_mtext); ?></span>
				</div>
			<?php endif; ?>
			<?php if($aak_topbar_menushow && has_nav_menu( 'menu-top' ) || $aak_topbar_search ): ?>
				<div class="col-md-auto ml-auto">
					<div class="topmenu-serch">
			<?php if($aak_topbar_menushow && has_nav_menu( 'menu-top' )): ?>
						<div class="top-menu list-hide text-white">
							<?php 
								wp_nav_menu(
									array(
										'theme_location' => 'menu-top',
										'menu_id'        => 'aaktop-menu',
										'menu_class'     => 'aaktop-menu',
										'depth'          => 1,
										'fallback_cb'    => false,							
									)
								);
							 ?>
						</div>
						<?php endif; ?>
						<?php if($aak_topbar_search): ?>
						<div class="header-top-search">
							<?php get_search_form(); ?>
						</div>	
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
<?php 	
 }
add_action('aak_header_top_display','aak_header_top_display_item');

?>

