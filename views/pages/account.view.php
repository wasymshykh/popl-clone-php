
<div class="profile-head">
    <div class="profile-avatar">
        <div class="profile-avatar-icon">
            <img src="<?=URL?>/static/images/<?=!empty($profile['user_profile_picture']) ? "uploads/" .$profile['user_profile_picture'] : 'default_avatar.png'?>" alt="<?=$profile['user_name']?>" alt="<?=$profile['user_name']?>">
        </div>
        <div class="profile-name">
            <h2><?=$profile['user_name']?></h2>
        </div>
    </div>
</div>

<div class="profile-card">
    <div class="profile-card-menu">
        <div class="profile-card-menu-item active" id="links">Links</div>
        <div class="profile-card-menu-item" id="bio">Biography</div>
    </div>
    
    <div class="profile-card-content">
        <div class="profile-card-content-item" id="for-links">
            
            <div class="profile-setting-buttons">
                <a href="<?=URL?>/u.php?slug=<?=$logged['user_profile_slug']?>&instant=on">Instant <span>On</span></a>
                <a href="<?=URL?>/edit_profile.php">Edit Profile</a>
            </div>

            <div class="profile-links">
                <?php foreach ($social as $s): if (empty($s['us_name'])) {continue;} ?>
                <div class="profile-link-box">
                    <div class="profile-link-icon">
                        <img src="<?=URL?>/static/images/social/<?=$s['sm_icon']?>" alt="Add">
                    </div>
                    <div class="profile-link-description">
                        <?=$s['sm_name']?>
                    </div>
                </div>
                <?php endforeach ?>

                <a href="<?=URL?>/edit_profile.php" class="profile-link-box">
                    <div class="profile-link-icon">
                        <img src="<?=URL?>/static/images/social/add.svg" alt="Add">
                    </div>
                    <div class="profile-link-description">
                        add link
                    </div>
                </a>
            </div>

        </div>
        <div class="profile-card-content-item" id="for-bio">



        </div>
    </div>
</div>
