<?php
//<input type="submit" class="ubermenu-search-submit" value="&#xf002;" />
function ubermenu_searchbar( $placeholder = null , $post_type = '' ){
	if( is_null( $placeholder ) ){
		$placeholder = __( 'Search...' , 'ubermenu'  );
	}

	$toggle_icon_tag = ubermenu_op( 'icon_tag' , 'main' ); //just grab from the main config
	if( !$toggle_icon_tag ) $toggle_icon_tag = 'i';
	?>
	<!-- UberMenu Search Bar -->
	<div class="ubermenu-search">
		<form role="search" method="get" class="ubermenu-searchform" action="<?php echo home_url( '/' ); ?>">
			<input type="text" placeholder="<?php echo $placeholder; ?>" value="" name="s" class="ubermenu-search-input" />
			<?php if( $post_type ): ?>
			<input type="hidden" name="post_type" value="<?php echo $post_type; ?>" />
			<?php endif; ?>
			<button type="submit" class="ubermenu-search-submit"><<?php echo $toggle_icon_tag; ?> class="fas fa-search" title="Search"></<?php echo $toggle_icon_tag; ?>></button>
		</form>
	</div>
	<!-- end .ubermenu-search -->
	<?php
}

function ubermenu_searchbar_shortcode( $atts , $content ){

	extract( shortcode_atts( array(
		'placeholder' => __( 'Search...' , 'ubermenu' ),
		'post_type'	=> '',
	), $atts ) );

	ob_start();
	ubermenu_searchbar( $placeholder , $post_type );
	$s = ob_get_clean();

	return $s;
}
add_shortcode( 'ubermenu-search' , 'ubermenu_searchbar_shortcode' );