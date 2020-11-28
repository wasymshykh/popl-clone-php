<?php

require 'app/start.php';

$logged = check_auth();
if (!$logged) {
    go(URL . '/login');
}

require_once LAYOUT_DIR.'profile_header.view.php';
include_once PAGE_DIR.'activate.view.php';
include_once LAYOUT_DIR.'profile_footer.view.php';
