<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aak
 */

$aak_page_container = get_theme_mod( 'aak_page_container', 'container');
$aak_page_layout = get_theme_mod( 'aak_page_layout', 'rightside');

if ( is_active_sidebar( 'sidebar-1' ) && $aak_page_layout != 'fullwidth' ) {
	$aak_column_set = '9';
}else{
	$aak_column_set = '12';
}
get_header();

?>
<div class="<?php echo esc_attr($aak_page_container); ?> mt-3 mb-5 pt-5 pb-3">
	<div class="row">
		<?php if ( is_active_sidebar( 'sidebar-1' ) && $aak_page_layout == 'leftside' ): ?>
			<div class="col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
		<div class="col-lg-<?php echo esc_attr($aak_column_set); ?>">
			<main id="primary" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div>
	<?php if ( is_active_sidebar( 'sidebar-1' ) && $aak_page_layout == 'rightside' ): ?>
		<div class="col-lg-3">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
	</div> <!-- end row -->
</div> <!-- end container -->
<?php
get_footer();