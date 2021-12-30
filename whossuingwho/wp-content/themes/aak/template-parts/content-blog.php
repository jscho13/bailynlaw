<?php 
/*
*
* The file for display blog content for aak theme
*
*/
$aak_categories_list = get_the_category_list( esc_html__( ', ', 'aak' ) );
$aak_blog_style = get_theme_mod( 'aak_blog_style', 'grid');
$aak_postcat_show = get_theme_mod( 'aak_postcat_show', 1 );


if(!is_single() && $aak_blog_style == 'list'):
	get_template_part( 'template-parts/list', 'blog' );
else:

?>
<div class="col-md-4 grid-item mb-4">
	<div class="card aakcard">
		<?php if(has_post_thumbnail()): ?>
			<?php aak_post_thumbnail(); ?>
		<?php endif; ?>
	    <div class="card-body">
	    	<?php the_title( '<h5 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
	    	<?php if ( 'post' === get_post_type() ) :
							?>
				<div class="entry-meta mb-3">
					<?php
						aak_posted_on();
						aak_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
	      <div class="card-text">
	      	<?php the_excerpt(); ?></div>
	      <footer class="blockquote-footer">
	        <small class="text-muted">
	        <?php
	         if ( $aak_categories_list && $aak_postcat_show ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( '- %1$s', 'aak' ) . '</span>', $aak_categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} ?>

	        </small>
	      </footer>
	    </div>
	  </div>
  </div>
<?php endif; ?>