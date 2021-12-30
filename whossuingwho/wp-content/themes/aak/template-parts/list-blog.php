<?php 
/*
*
* The file for display blog content for aak theme
*
*/
$aak_categories_list = get_the_category_list( esc_html__( ', ', 'aak' ) );

if(has_post_thumbnail()){
	$aak_list_text_class = 'col-lg-8 col-md-6 col-sm-12';
}else{
	$aak_list_text_class = 'col-lg-12 aakno-img';
}
$aak_postcat_show = get_theme_mod( 'aak_postcat_show', '1' );

?>

<div class="card aak-list-blog">
<div class="row">
	<?php if(has_post_thumbnail()): ?>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<?php aak_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	<div class="card-text <?php echo esc_attr($aak_list_text_class); ?>">
	    <div class="card-body-text">
	    	<?php if ( 'post' === get_post_type() ) :
							?>
				<div class="entry-meta">
					<?php
						aak_posted_on();
						aak_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
	    	<?php the_title( '<h5 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
	    	
	      <div class="card-text">
	      	<?php the_excerpt(); ?></div>
	      <footer class="blockquote-footer text-right ">
	        <small class="text-muted">
	        <?php
	         if ( $aak_categories_list && $aak_postcat_show) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( '- %1$s', 'aak' ) . '</span>', $aak_categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} ?>

	        </small>
	      </footer>
	    </div>
    </div>
  </div>
  </div>
