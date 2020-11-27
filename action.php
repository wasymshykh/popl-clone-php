<?php

require 'app/start.php';

$logged = check_auth();
if (!$logged) {
    go(URL . '/login');
}

if (isset($_GET['instant']) && !empty($_GET['instant'])) {
    $status = normal_text($_GET['instant']);
    $status = $status == "off" ? "on" : "off";
    update_user_instant_status($status, $logged['user_id']);
}

go(URL . '/u/' . $logged['user_profile_slug']);
