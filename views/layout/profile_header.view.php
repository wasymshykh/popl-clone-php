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

    <header id="header" class="user">
        <div class="header-inner">

            <?php if($logged): ?>
                <div class="header-link">
                    <div id="menu">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            <?php endif; ?>

            <a href="<?=URL?>" class="header-logo">
                <img src="<?=URL?>/static/images/logo.png" alt="Logo">
            </a>
            
            <div></div>
        </div>
    </header>

<?php if($logged): ?>
    <div id="user-menu" class="closed">
        <div class="menu-content">

            <div class="menu-content-inner">
                <ul>
                    <li><a href="<?=URL?>/u/<?=$logged['user_profile_slug']?>"><i class="menu-icon menu-icon-home"></i> Home</a></li>
                    <li><a href="<?=URL?>/edit_profile"><i class="menu-icon menu-icon-profile"></i> Wijzig Profiel</a></li>
                    <li><a href="<?=URL?>/"><i class="menu-icon menu-icon-activate"></i> Activate</a></li>
                    <li><a href="<?=URL?>/"><i class="menu-icon menu-icon-help"></i> Uitleg</a></li>
                    <li><a href="<?=URL?>/logout"><i class="menu-icon menu-icon-logout"></i> Loguit</a></li>
                </ul>
            </div>

        </div>
    </div>

    <script>

        function close_menu() {
            document.querySelector("#user-menu").classList.add('closed')
        }
        function open_menu() {
            document.querySelector("#user-menu").classList.remove('closed')
        }

        document.querySelector("#user-menu").addEventListener('click', (e) => {
            
            if (e.target.id === "user-menu") {
                close_menu();
            }
            console.log(e.target.id);

        })

        document.querySelector("#menu").addEventListener('click', (e) => {
            open_menu();
        })
    </script>
<?php endif; ?>

    <section id="content">
        <div class="content-inner">
