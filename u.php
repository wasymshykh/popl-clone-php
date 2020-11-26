<?php

require 'app/start.php';

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


$owner = false;
if ($logged) {
    if ($logged['user_id'] == $profile['user_id']) {
        $owner = true;
    }
} else {
    
    if ($profile['user_instant'] == "ON") {
        $social = get_social_links_by_profile($profile['user_id'], false);

        $redirect = URL;
        if ($social) {

            foreach ($social as $value) {
                if (!empty(normal_text($value['us_name']))) {
                    $redirect = $value['sm_url'] . $value['us_name'];
                }
            }

            go($redirect);
        }
    }

}

$social = get_social_links_by_profile($profile['user_id']);

if (!$social) {
    $social = [];
}


require_once LAYOUT_DIR.'profile_header.view.php';

include_once PAGE_DIR.'account.view.php';

include_once LAYOUT_DIR.'profile_footer.view.php';
