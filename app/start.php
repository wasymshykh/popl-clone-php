<?php

    session_start();

    // Main project directory
    define('DIR', dirname(__DIR__).'/');
    
    // Either: development/production
    define('PROJECT_MODE', 'development'); 
    
    if (PROJECT_MODE !== 'development') {
        error_reporting(0);
    }

    
    define('LAYOUT_DIR', dirname(__DIR__).'/views/layout/');
    define('PAGE_DIR', dirname(__DIR__).'/views/pages/');

    // Database details
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'popl_clone_db');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    // Timezone setting
    define('TIMEZONE', 'Asia/Karachi');
    date_default_timezone_set(TIMEZONE);
    
    define('SECRET', 'test');
    define('SESSION_EXPIRE_TIME', 3600);

    // Auto load classes
    include DIR . 'app/auto_loader.php';

    // Functions
    include DIR . 'app/functions.php';

    // Get db handle
    $db = (new DB())->connect();
    $settings = new Settings($db);
    
    define('URL', $settings->protocol().'://'.$settings->site_url());
