<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aak
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(is_single()): ?>
		<?php get_template_part( 'template-parts/content', 'single' ); ?>
	<?php else: ?>
		<?php get_template_part( 'template-parts/content', 'blog' ); ?>
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
