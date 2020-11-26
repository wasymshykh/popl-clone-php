<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$settings->get_all()['site_title']?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="static/css/style.css">

</head>
<body>

    <header id="header">
        <div class="header-inner">

            <?php if(!isset($no_login)): ?>
                <div class="header-link">
                    <a href="<?=URL?>/login.php">Login</a>
                </div>
            <?php endif; ?>

            <a href="<?=URL?>" class="header-logo">
                <img src="static/images/logo.png" alt="Logo">
            </a>

            <?php if(!isset($no_login)): ?>
                <div class="header-link">
                    <a href="<?=URL?>/register.php">Register</a>
                </div>
            <?php endif; ?>

        </div>
    </header>

    <section id="content">
        <div class="content-inner">