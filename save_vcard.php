<?php

require 'app/start.php';
require DIR . '/vendor/autoload.php';

$logged = check_auth();

if (!isset($_GET['slug'])) {
    if ($logged) {
        go(URL . '/u.php?slug=' . $logged['user_profile_slug']);
    } else {
        go(URL);
    }
}
$slug = normal_text($_GET['slug']);
$profile = get_profile_by_slug($slug);
if (!$profile) {
    if ($logged) {
        go(URL . '/u.php?slug=' . $logged['user_profile_slug']);
    } else {
        go(URL);
    }
}

use JeroenDesloovere\VCard\VCard;

$vcardObj = new VCard();

$vcardObj->addName($profile['user_name']);
$vcardObj->addEmail($profile['user_email']);
$vcardObj->addPhoneNumber($profile['user_phone']);
if (!empty($profile['user_address'])) {
    $vcardObj->addAddress($profile['user_address']);
}

$vcardObj->download();
exit();
