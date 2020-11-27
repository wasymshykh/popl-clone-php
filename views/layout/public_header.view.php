<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$settings->get_all()['site_title']?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=URL?>/static/css/style.css">

    <script src="https://kit.fontawesome.com/dafd3b2d44.js" crossorigin="anonymous"></script>

</head>
<body>

    <header id="header">
        <div class="header-inner">

            <?php if(isset($logged) && $logged): ?>
                <div class="header-link">
                    <a href="<?=URL?>/logout">Logout</a>
                </div>
            <?php else: ?>
                <div class="header-link">
                    <a href="<?=URL?>/login">Login</a>
                </div>
            <?php endif; ?>

            <a href="<?=URL?>" class="header-logo">
                <img src="<?=URL?>/static/images/logo.png" alt="Logo">
            </a>

            <?php if(isset($logged) && $logged): ?>
                <div class="header-link">
                    <a href="<?=URL?>/u/<?=$logged['user_profile_slug']?>">Profile</a>
                </div>
            <?php else: ?>
                <div class="header-link">
                    <a href="<?=URL?>/register">Register</a>
                </div>
            <?php endif; ?>

        </div>
    </header>

    <section id="content">
        <div class="content-inner">
