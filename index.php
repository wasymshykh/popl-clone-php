<?php

require 'app/start.php';

$logged = check_auth();

require_once LAYOUT_DIR.'public_header.view.php';
include_once PAGE_DIR.'home.view.php';
include_once LAYOUT_DIR.'public_footer.view.php';
