<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Aak
 */

get_header();


$aak_blog_container = get_theme_mod( 'aak_blog_container', 'container');
$aak_blog_layout = get_theme_mod( 'aak_blog_layout', 'rightside');

if ( is_active_sidebar( 'sidebar-1' ) && $aak_blog_layout != 'fullwidth' ) {
	$aak_column_set = '9';
}else{
	$aak_column_set = '12';
}

?>
<div class="<?php echo esc_attr($aak_blog_container); ?> mt-3 mb-5 pt-5 pb-3">
	<div class="row">
		<?php if ( is_active_sidebar( 'sidebar-1' ) && $aak_blog_layout == 'leftside' ): ?>
			<div class="col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
		<div class="col-lg-<?php echo esc_attr($aak_column_set); ?>">
			<main id="primary" class="site-main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header search-header text-center mb-5">
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( __( 'Search Results for: %s', 'aak' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</header><!-- .page-header -->

					<?php
					echo '<div class="card-columns">';
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;
					echo '</div>';
					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->
		</div>
	<?php if ( is_active_sidebar( 'sidebar-1' ) && $aak_blog_layout == 'rightside' ): ?>
		<div class="col-lg-3">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
	</div> <!-- end row -->
</div> <!-- end container -->

<?php
get_footer();