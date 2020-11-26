<?php

require 'app/start.php';

if (isset($_COOKIE['x-log-s'])) {
    setcookie("x-log-s", "", time() - 3600); 
}

if (isset($_SESSION['user_id']) || isset($_SESSION['logged'])) {
    session_unset();
    session_destroy();
}

go(URL);
