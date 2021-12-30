<?php

  define('HTTP_SERVER', 'https://bailynlaw.com/');  
  define('HTTPS_SERVER', 'https://bailynlaw.com/');  
  define('ENABLE_SSL', false);  
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '');
  define('HTTPS_COOKIE_PATH', '');

  define('DIR_ROOT', $_SERVER["DOCUMENT_ROOT"]);
  define('DIR_HTTP_CATALOG', 'https://bailynlaw.com/');
  define('DIR_HTTPS_CATALOG', 'https://bailynlaw.com/'); 

  define('DIR_IMAGES', 'images/'); 
  define('DIR_INCLUDES', DIR_ROOT.'/inc/'); 
  define('DIR_LANGUAGES', DIR_INCLUDES . 'languages/'); 
  define('DIR_FUNCTIONS', DIR_INCLUDES . 'functions/');
  
  define('DIR_THEME', '/themes');
  define('CURRENT_THEME', DIR_THEME.'/v1');
  define('DIR_THEME_ASSETS',CURRENT_THEME.'/assets');
  define('DIR_THEME_INCLUDES',CURRENT_THEME.'/inc');
  define('DIR_THEME_CSS',DIR_THEME_ASSETS.'/css');
  define('DIR_THEME_IMG',DIR_THEME_ASSETS.'/images');
  define('DIR_THEME_JS',DIR_THEME_ASSETS.'/js');
  define('DIR_THEME_PARTIAL',CURRENT_THEME.'/partial');


  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/');
  
  // define our database connection
  define('DB_SERVER', 'localhost'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'bailynlaw_codeigniter_user');
  define('DB_SERVER_PASSWORD', 'Manager0201!+');
  define('DB_DATABASE', 'bailynlaw_codeigniter10132019');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', ''); // leave empty '' for default handler or set to 'mysql'
