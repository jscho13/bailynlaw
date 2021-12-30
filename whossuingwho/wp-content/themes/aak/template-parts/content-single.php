<?php 
/*
*
* The file for display blog content for aak theme
*
*/
$aak_blogdate = get_theme_mod( 'aak_blogdate', 1 );
$aak_blogauthor = get_theme_mod( 'aak_blogauthor', 1 );
$aak_postcat_show = get_theme_mod( 'aak_postcat_show', 1 );
$aak_posttags_show = get_theme_mod( 'aak_posttags_show', 1 );
?>
<div class="aak-single-list">
	<header class="entry-header text-center mb-5">
			<?php
			if ( is_singular() ) :
				the_title( '<h2 class="entry-title">', '</h2>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					if($aak_blogdate){
						aak_posted_on();
					}
					if($aak_blogauthor){
						aak_posted_by();
					}
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php aak_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			if(is_single( )){
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aak' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aak' ),
					'after'  => '</div>',
				)
			);
		}else{
			the_excerpt();
		}


			?>
		</div><!-- .entry-content -->
	<?php if($aak_postcat_show || $aak_posttags_show): ?>
		<footer class="entry-footer">
			<?php aak_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
		
	</div>