<?php
use com\cminds\listmanager\plugin\options\Options;
?>

.cmlm .cmlm-search-description { font-size: 0.9em; }
.cmlm-gutter-sizer { width: 3%; }
.cmlm .cmlm-category-box { padding: 0; margin: 0; }
li.cmlm-category-link-list-entry {
    position: relative;
}

/*
 * Share buttons
.cmlm-social { clear: both; float: left; width: auto; padding-top: 5px;}
 */
.cmlm-social {
    width: 0;
	height: 27px;
    padding-top: 0;
    position: absolute;
    left: 28px;
    bottom: 1px;
    box-sizing: border-box !important;
	display: block;
	transition: all ease 0.2s;
	overflow: hidden;
}
.cmlm-social.show {
	width: auto;
}
.cmlm-social-wrapper { 
	display: inline-block;
	position: relative;
}
.cmlm-social-wrapper.newline { 
	display: block;
}
.cmlm-social-wrapper.newline .cmlm-social-share-btn { 
	position: relative;
}
/*.cmlm-social-wrapper.onhover:hover .cmlm-social { 
	width:auto;
	overflow: visible;
}*/
.cmlm-social-share-btn {
	width: 25px;
	height: 25px;
	box-sizing: border-box;
	position: absolute;
	/* border: 1px solid #000; */
	border-radius: 3px;
    left: 1px;
    bottom: 1px;
	background-size: contain;
}
.cmlm-social-share-btn svg {
    display: block;
    height: 100%;
    width: 100%;
	fill: #999;
}
.cmlm-social-share-btn:hover {
	cursor: pointer;
}
.cmlm-social-wrapper:hover .cmlm-social-share-btn svg {
	fill: #336;
}
.cmlm-share-btn { padding-right: 2px; }
.cmlm-share-btn, .cmlm-share-btn:active, .cmlm-share-btn:hover { text-decoration: none; box-shadow:none !important; border-bottom: 0;}
.cmlm-social .cmlm-share-btn img { display: inline-block; height: auto; box-shadow: unset; }

/*
 * PAGINATION
 */
.cmlm-category-box.cmlm_pagination {
    width: 100%;
    display: block;
    position: relative;
    height: 30px;
    margin-bottom: 10px;
}
.cmlm_pagination-wrapper {
    float: right;
    width:auto;
}
.cmlm_pagination_pin {
    float: left;
    height: 30px;
    width: 30px;
    border: 1px solid rgba(0,0,0,.15);
    line-height: 30px;
    text-align: center;
}
.cmlm_pagination_pin:last-of-type {
    float: left;
    height: 30px;
    width: 30px;
    border: 1px solid rgba(0,0,0,.15);
    line-height: 30px;
    text-align: center;
}
.cmlm_pagination_pin a {
    text-decoration-line: none !important;
    box-shadow: none;
    display: block;
    color: #000;
    width: 100%;
    height: 100%;
}
.cmlm_pagination_pin a:hover {
    box-shadow: none;
    background-color: rgba(0,0,0,.15);
}
.cmlm_pagination_pin span {
    display: block;
    widows: 100%;
    height: 100%;
}
.cmlm_pagination_pin.active {
    background-color: rgba(0,0,0,.15);
}
.cmlm-js-placeholder {
	font-family: 'Segoe UI';
}
.cmlm-content-links {
	opacity: 1;
	transition: opacity .3s ease;
}
.cmlm-content-links.hidden{
	opacity: 0;
	transition: opacity .3s ease;
}
.cmlm-pagination-btn.hidden,
.cmlm_pagination_pin.hidden{
	opacity: 0;
	border: none;
}

.cmlm-loader {
    height: 100%;
    width: 100%;
    background: #fff;
    position: absolute;
    z-index: 9;
}
.cmlm-loader.cmlm-hidden-loader {
    display: none;
}
.cmlm-loader-big {
    text-align: center;
    position: relative;
    top: 20%;
}
.cmlm-loader-big img {
    width: 30px;
    height: 30px;
}

.cmlm .cmlm-content {
  overflow: hidden;
}

.cmlm .cmlm-content-single {
    overflow: hidden;
    position: relative;
}
a.cmlm-pagination-btn:focus {
    outline: none;
}

/*

  Like button

  */
.cmlm-like-wrapper {
    float: right;
    padding-top: 5px;
}
a.cmlm-like-btn  {
    padding-right: 5px;
    font-size: 16px;
    color: #000;
    text-decoration-line: none !important;
    vertical-align: middle;
}
a.cmlm-like-btn:visited,
a.cmlm-like-btn:hover {
    color: #000;
}
.cmlm-like-btn-img {
    width: 18px;
    height: auto;
    vertical-align: middle;
    padding-right: 5px;
}
.cmlm-like-wrapper  span {
    font-size: 16px;
    vertical-align: middle;
}
.cmlm-like-btn,
.cmlm-like-btn:active,
.cmlm-like-btn:hover {
    text-decoration: none;
    box-shadow:none !important;
}

<?php if (Options::getOption('tooltip_text_color')): ?>
    .style-cmlm-tooltip.opentip-container .opentip { color: <?php echo Options::getOption('tooltip_text_color'); ?> !important; }
<?php endif; ?>

<?php if (Options::getOption('category_font_size')): ?>
    .cmlm .cmlm-header { font-size: <?php echo Options::getOption('category_font_size'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('category_background_color')): ?>
    .cmlm .cmlm-header { background: <?php echo Options::getOption('category_background_color'); ?> !important; padding-left:5px; }
<?php endif; ?>
<?php if (Options::getOption('category_text_color')): ?>
    .cmlm .cmlm-header { color: <?php echo Options::getOption('category_text_color'); ?> !important; }
<?php endif; ?>

<?php if (Options::getOption('link_font_size')): ?>
    .cmlm .cmlm-link { font-size: <?php echo Options::getOption('link_font_size'); ?> !important; }
    .cmlm .cmlm-link-checkbox { font-size: <?php echo Options::getOption('link_font_size'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_subtitle_font_size')): ?>
    .cmlm .cmlm-link-subtitle { font-size: <?php echo Options::getOption('link_subtitle_font_size'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_hover_color')): ?>
    .cmlm .cmlm-category-link-list-entry:hover { background: <?php echo Options::getOption('link_hover_color'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_image_height')): ?>
    .cmlm .cmlm-link-image{ height: <?php echo Options::getOption('link_image_height'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_image_width')): ?>
    .cmlm .cmlm-link-image{ width: <?php echo Options::getOption('link_image_width'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('icon_size')): ?>
    .cmlm-social .cmlm-share-btn img { width: <?php echo Options::getOption('icon_size'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('icon_opacity')): ?>
    .cmlm-social .cmlm-share-btn { opacity: <?php echo Options::getOption('icon_opacity'); ?>; }
<?php endif; ?>
.cmlm-social .cmlm-share-btn:active,.cmlm-social .cmlm-share-btn:hover { opacity:1; }
<?php if (Options::getOption('tooltip_font_size')): ?>
    .style-cmlm-tooltip.opentip-container .opentip { font-size: <?php echo Options::getOption('tooltip_font_size'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_opacity')): ?>
    .cmlm a.cmlm-link { opacity: <?php echo Options::getOption('link_opacity'); ?>; }
    .cmlm a.cmlm-link .cmlm-link-subtitle { opacity: <?php echo Options::getOption('link_opacity'); ?>; }
<?php endif; ?>
.cmlm a.cmlm-link:hover { opacity: 1; }
.cmlm a.cmlm-link:hover .cmlm-link-subtitle { opacity: 1; }
<?php if (Options::getOption('link_subtitle_color')): ?>
    .cmlm a.cmlm-link .cmlm-link-subtitle { color: <?php echo Options::getOption('link_subtitle_color'); ?> !important; }
<?php endif; ?>
<?php if (Options::getOption('link_title_color')): ?>
    .cmlm a.cmlm-link { color: <?php echo Options::getOption('link_title_color'); ?> !important; }
<?php endif; ?>
<?php if ( !Options::getOption('show_tagfile_icon')): ?>
    .cmlm-category-link-list-entry div.tag-link-wrapper { 
		width: auto !important;
		position: absolute !important;
		float: none !important;
		bottom: 0;
		right: 2px;
	}
    .cmlm-category-link-list-entry span.cmlm-link-subtitle { 
		width: 50% !important;
		padding-left: 3px;
	}
<?php endif; ?>
.cmlm-link-event-date { 
    <?php if (Options::getOption('event_date_font_size')): ?>
        font-size: <?php echo Options::getOption('event_date_font_size'); ?> !important; 
    <?php endif; ?>
    <?php if (Options::getOption('event_date_font_style')): ?>
        font-style: <?php echo Options::getOption('event_date_font_style'); ?> !important; 
    <?php endif; ?> 
    <?php if(Options::getOption('event_date_text_color')): ?>
        color: <?php echo Options::getOption('event_date_text_color'); ?> !important;
    <?php endif; ?>
}
