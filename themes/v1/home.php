<?php
include DIR_ROOT.DIR_THEME_PARTIAL.'/header.php';
include DIR_ROOT.DIR_THEME_PARTIAL.'/menu-home.php';
?>

<?php include DIR_ROOT.DIR_THEME_PARTIAL.'/home/home-section1.php';?>

<script>
  jQuery('#services-mega-menu-home .inner-menu-hidden').hide();
  jQuery('#services-mega-menu-home .inner-menu-trigger').click(function(){
    jQuery(this).closest('#services-mega-menu-home .inner-sub-menu-plus').html(jQuery(this).closest('#services-mega-menu-home .inner-sub-menu-plus').text() == '+' ? '-' : '+');
    jQuery(this).next('#services-mega-menu-home .inner-menu-hidden').toggle();
  });
</script>

<?php  include DIR_ROOT.DIR_THEME_PARTIAL.'/home/home-section2.php';?>

<?php  include DIR_ROOT.DIR_THEME_PARTIAL.'/footer-home.php';?>
