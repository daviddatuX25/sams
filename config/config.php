<?php
    define("DB_HOST", "localhost");
    define("DB_NAME", "sams_db");
    define("DB_USER", "root");
    define("DB_PASS", "");

    define('BASE_URL', '/sams');
    define('BASE_URL_PUBLIC', BASE_URL . '/public');
    // Change public/.htaccess to RewriteBase /sams/public
    define('BRAND_LOGO_PATH', BASE_URL_PUBLIC . '/img/brand_logo/white_on_trans.png');
    
    require_once 'autoload.php';
?>