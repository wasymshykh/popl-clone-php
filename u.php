<?php

require 'app/start.php';

$logged = check_auth();
if (!$logged) {
    go(URL . '/login.php');
}

if (!isset($_GET['slug'])) {
    go(URL . '/u.php?slug=' . $logged['user_profile_slug']);
}

$slug = normal_text($_GET['slug']);
$profile = get_profile_by_slug($slug);

if (!$profile) {
    go(URL . '/u.php?slug=' . $logged['user_profile_slug']);
}

$social = get_social_links_by_profile($profile['user_id']);

if (!$social) {
    $social = [];
}

require_once LAYOUT_DIR.'profile_header.view.php';

if ($profile['user_id'] == $logged['user_id']) {
    include_once PAGE_DIR.'account.view.php';
} else {
    include_once PAGE_DIR.'profile.view.php';
}
include_once LAYOUT_DIR.'profile_footer.view.php';
