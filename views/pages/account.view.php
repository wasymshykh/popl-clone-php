
<div class="profile-head">
    <div class="profile-avatar">
        <div class="profile-avatar-icon">
            <img src="<?=URL?>/static/images/<?=!empty($profile['user_profile_picture']) ? "uploads/" .$profile['user_profile_picture'] : 'default_avatar.png'?>" alt="<?=$profile['user_name']?>" alt="<?=$profile['user_name']?>">
        </div>
        <div class="profile-name">
            <h2><?=$profile['user_name']?></h2>
            <p><span id="profile-url"><?=$profile['user_profile_slug']?></span> <i class="fas fa-copy" id="copy"></i></p>
        </div>
    </div>
</div>

<div class="profile-card">
    <div class="profile-card-menu">
        <div class="profile-card-menu-item active" id="links">Links</div>
        <div class="profile-card-menu-item" id="bio">Biography</div>
    </div>
    
    <div class="profile-card-content">
        <div class="profile-card-content-item active" id="for-links">

            <?php if($owner): ?>
            <div class="profile-setting-buttons">
                <a href="<?=URL?>/action.php?instant=<?=strtolower($logged['user_instant'])?>"><i class="fas fa-toggle-<?=strtolower($logged['user_instant'])?>"></i> Instant <span><?=strtolower($logged['user_instant'])?></span></a>
                <a href="<?=URL?>/edit_profile.php"><i class="fas fa-pencil-alt"></i> Edit Profile</a>
            </div>
            <?php endif; ?>

            <div class="profile-links">
                <?php $i = 0; foreach ($social as $s): if (empty($s['us_name'])) {continue;} ?>

                <?php if ($owner): ?>
                    <div class="profile-link-box social-media-box <?=$logged['user_instant'] == 'ON' ? (($i > 0) ? 'opacity-low' : '')  : '' ?>">
                    <?php else: ?>
                    <a href="<?=$s['sm_url'] . $s['sm_name']?>" class="profile-link-box social-media-box">
                <?php endif; ?>
                    <div class="profile-link-icon">
                        <img src="<?=URL?>/static/images/social/<?=$s['sm_icon']?>" alt="Add">
                    </div>
                    <div class="profile-link-description">
                        <?=$s['sm_name']?>
                    </div>
                
                <?php if ($owner): ?>
                    </div>
                <?php else: ?>
                    </a>
                <?php endif;
                    $i++; 
                    endforeach; ?>

                <a href="<?=URL?>/edit_profile.php" class="profile-link-box <?=($logged['user_instant'] == 'ON' && $owner) ? (($i > 0) ? 'opacity-low' : '')  : '' ?>">
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
            <p><?=nl2br($profile['user_bio']) ?></p>

            <?php if($owner): ?>
            <div class="profile-setting-buttons">
                <a href="<?=URL?>/edit_profile.php"><i class="fas fa-pencil-alt"></i> Edit Bio</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>

    document.querySelector("#links").addEventListener('click', () => {
        document.querySelector("#for-bio").classList.remove('active');
        document.querySelector("#for-links").classList.add('active');
        document.querySelector("#bio").classList.remove('active');
        document.querySelector("#links").classList.add('active');
    })
    document.querySelector("#bio").addEventListener('click', () => {
        document.querySelector("#for-bio").classList.add('active');
        document.querySelector("#for-links").classList.remove('active');
        document.querySelector("#bio").classList.add('active');
        document.querySelector("#links").classList.remove('active');
    })


    document.querySelector("#copy").addEventListener('click', (e) => {

        e.target.classList.remove('fa-copy');
        e.target.classList.add('fa-check');
        copy("<?=URL?>/u.php?slug=<?=$profile['user_profile_slug']?>")

        setTimeout(() => {
            e.target.classList.remove('fa-check')
            e.target.classList.add('fa-copy')
        }, 1000);

    })

    function copy(text) {
        let input = document.createElement('textarea');
        input.innerHTML = text;
        document.body.appendChild(input);
        input.select();
        let result = document.execCommand('copy');
        document.body.removeChild(input);
        return result;
    }

</script>
