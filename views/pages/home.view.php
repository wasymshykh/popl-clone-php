<div class="home-content">

    <h1>Welcome to <span><?=$settings->get_all()['site_title']?></span></h1>
    <p>Get started with the application</p>

    <?php if ($logged): ?>
    <div class="home-buttons">
        <a href="<?=URL?>/u/<?=$logged['user_profile_slug']?>">Go to profile</a>
        <span>or</span>
        <a href="<?=URL?>/edit_profile">Edit profile</a>
    </div>
    <?php else: ?>
    <div class="home-buttons">
        <a href="<?=URL?>/login">Login</a>
        <span>or</span>
        <a href="<?=URL?>/register">Join</a>
    </div>
    <?php endif; ?>

</div>
