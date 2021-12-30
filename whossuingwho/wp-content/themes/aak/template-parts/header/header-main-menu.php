<?php
/**
 * Template part for displaying header top bar
 *
 * @link https://wpthemespace.com/product/beshop
 *
 * @package BeShop
 */

$beshop_menu_logo = get_theme_mod( 'beshop_menu_logo');
$beshop_logo_position = get_theme_mod( 'beshop_logo_position','center');

?>

		<div class="beshop-main-nav bg-dark text-white">
			<div class="container">
				<div class="<?php if($beshop_menu_logo): ?>d-flex<?php else: ?>logo-hide<?php endif; ?>">
				<?php if($beshop_logo_position == 'left' && $beshop_menu_logo ): ?>
					<div class="menu-logo">
						<?php beshop_header_logo(1); ?>
					</div>
				<?php endif; ?>
					<div class="beshop-main-menu flex-grow-1">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="mshow"><?php esc_html_e( 'Menu', 'aak' ); ?></span><span class="mhide"><?php esc_html_e( 'Close Menu', 'aak' ); ?></span></button>
							<?php
							if ( has_nav_menu( 'menu-1' ) ) {

								wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									//'fallback_cb'     => 'wp_page_menu',
									'walker'        => new Beshop_Walker_Nav_Menu(),
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
										'walker'   => new Beshop_Walker_Page(),
									)
								);
								?>
							</ul>
							<?php

							}
							
							?>
						</nav><!-- #site-navigation -->
					</div>
					<?php if($beshop_logo_position == 'right' && $beshop_menu_logo): ?>
					<div class="menu-logo">
						<?php beshop_header_logo(); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if($beshop_logo_position == 'center' && $beshop_menu_logo): ?>
					<div class="menu-logo mt-3">
						<?php beshop_header_logo(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>