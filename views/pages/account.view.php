
<div class="profile-head" style="background-image: url(<?=URL?>/static/images/<?=!(empty($profile['user_profile_picture'])) ? "uploads/" .$profile['user_cover_picture'] : 'profile_bg.jpg'?>);">
    <div class="profile-avatar">
        <div class="profile-avatar-icon">
            <img src="<?=URL?>/static/images/<?=!empty($profile['user_profile_picture']) ? "uploads/" .$profile['user_profile_picture'] : 'default_avatar.png'?>" alt="<?=$profile['user_name']?>" alt="<?=$profile['user_name']?>">
        </div>
        <div class="profile-name">
            <h2><?=$profile['user_name']?></h2>
            <p><span id="profile-url"><?=URL?>/u/<?=$profile['user_profile_slug']?></span> <i class="fas fa-copy" id="copy"></i></p>
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
                <a id="change-instant" href="<?=URL?>/action/<?=strtolower($logged['user_instant'])?>"><i class="fas fa-toggle-<?=strtolower($logged['user_instant'])?>"></i> Instant <span><?=strtolower($logged['user_instant'])?></span></a>
                <a href="<?=URL?>/edit_profile"><i class="fas fa-pencil-alt"></i> Edit Profile</a>
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

                <?php if($owner): ?>
                <a href="<?=URL?>/edit_profile" class="profile-link-box <?=($logged['user_instant'] == 'ON' && $owner) ? (($i > 0) ? 'opacity-low' : '')  : '' ?>">
                    <div class="profile-link-icon">
                        <img src="<?=URL?>/static/images/social/add.svg" alt="Add">
                    </div>
                    <div class="profile-link-description">
                        add link
                    </div>
                </a>
                <?php endif; ?>
            </div>

        </div>

        <div class="profile-card-content-item" id="for-bio">
            <p><?=nl2br($profile['user_bio']) ?></p>

            <?php if($owner): ?>
            <div class="profile-setting-buttons">
                <a href="<?=URL?>/edit_profile"><i class="fas fa-pencil-alt"></i> Edit Bio</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($profile['user_phone']): ?>
<div class="vcard">
    <a href="<?=URL?>/save_vcard/<?=$profile['user_profile_slug']?>"><i class="fas fa-plus"></i> Save vcard</a>
</div>
<?php endif; ?>

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
        copy("<?=URL?>/u/<?=$profile['user_profile_slug']?>")

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


    <?php if($owner): ?>

        document.querySelector("#change-instant").addEventListener('click', (e)=>{
            e.preventDefault();
            let s = "on";
            
            if (e.target.text.trim() === "Instant off") {
                s = "off"
            }
            change_instant(s);
        })

        function remove_opacity() {

            let smboxes = document.querySelectorAll(".profile-link-box")

            for (let i = 0; i < smboxes.length; i++) {
                const element = smboxes[i];
                element.classList.remove('opacity-low')
            }

        }

        function add_opacity() {
            let smboxes = document.querySelectorAll(".profile-link-box")

            for (let i = 1; i < smboxes.length; i++) {
                const element = smboxes[i];
                element.classList.add('opacity-low')
            }

        }

        function change_instant(s) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (s === "on") {
                        btn_html = '<i class="fas fa-toggle-off"></i> Instant off';
                        remove_opacity();

                    } else {
                        btn_html = '<i class="fas fa-toggle-on"></i> Instant on';
                        add_opacity();

                    }
                    document.querySelector("#change-instant").innerHTML = btn_html; 
                    console.log('yess');

                }
            };
            xhttp.open("GET", "<?=URL?>/action/"+s, true);
            xhttp.send();
        }

    <?php endif; ?>

</script>
