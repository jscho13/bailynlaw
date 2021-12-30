<?php 
require $_SERVER['DOCUMENT_ROOT'].'/inc/application_top.php';

$pageTitle = 'Episodes | Think Like a Lawyer - BAILYN LAW';
$meta_description = '';
$meta_image = '';

$slug = (isset($_GET['slug']) && $_GET['slug'] != '') ? $_GET['slug'] : '';

if(empty($slug)){
    $url = $_SERVER['REQUEST_URI']; 
    $url  = explode('/', $url );
      
    $notVlog = $url[1];
    $slug = $url[4];
}
 
 
if(empty($slug)){  
     include DIR_ROOT.CURRENT_THEME.'/vlog.php';
}
   
else
    include DIR_ROOT.CURRENT_THEME.'/vlog-article.php';
?>