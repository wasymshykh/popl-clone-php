<div class="page-top">
    <div class="page-back">
        <a href="<?=URL?>/u/<?=$logged['user_profile_slug']?>">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="page-title">
        <h1>Profile Settings</h1>
        <p>Update your profile</p>
    </div>
</div>

<div class="settings-page">
    <?php if ($image_msg): ?>
    <div class="form-message form-<?=$image_msg['type']?>">
        <?=$image_msg['message']?>
    </div>
    <?php endif; ?>
    <div class="profile-avatar">
        <label for="profile-picture" class="profile-avatar-icon" id="profile_picture">
            <img src="<?=URL?>/static/images/<?=!empty($profile['user_profile_picture']) ? "uploads/" .$profile['user_profile_picture'] : 'default_avatar.png'?>" alt="<?=$profile['user_name']?>" id="avatar">
        </label>
        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data" class="profile-change" >
            <label for="profile-picture">upload picture</label>
            <input type="file" accept="image/*" name="profile-picture" id="profile-picture" onchange="loadFile(event)">
            <input type="hidden" name="s-i">
            <button type="submit" id="image-change-btn" class="no-display">Save Change</button>
        </form>
    </div>
</div>

<div class="profile-settings">
    <div class="profile-settings-section">
        <h3>About You</h3>
        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" class="page-form">
            <?php if ($msg): ?>
            <div class="form-message form-<?=$msg['type']?>">
                <?=$msg['message']?>
            </div>
            <?php endif; ?>
            <div class="form-input">
                <label for="inp-name">Your <b>Name</b></label>
                <input type="text" name="name" id="inp-name" placeholder="e.g. John" value="<?=$_POST['name'] ?? $logged['user_name']?>" required>
            </div>
            <div class="form-input">
                <label for="inp-bio">Your <b>Bio</b></label>
                <textarea name="bio" id="inp-bio" cols="30" rows="8"><?=$_POST['bio'] ?? $logged['user_bio']?></textarea>
            </div>
            
            <div class="form-input">
                <label for="inp-phone">Your <b>Phone</b></label>
                <input type="text" name="phone" id="inp-phone" placeholder="e.g. +1302102210" value="<?=$_POST['phone'] ?? $logged['user_phone']?>">
            </div>

            <div class="form-input">
                <label for="inp-address">Your <b>Address</b></label>
                <input type="text" name="address" id="inp-address" placeholder="e.g. 12th street" value="<?=$_POST['address'] ?? $logged['user_address']?>">
            </div>

            <div class="form-submit">
                <button>Update <i class="fas fa-arrow-right"></i></button>
            </div>

            <input type="hidden" name="s-e">
        </form>
    </div>

    <div class="profile-settings-section">
        <h3>Social Media</h3>

        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" class="page-form">
            <?php if ($msg_social): ?>
            <div class="form-message form-<?=$msg_social['type']?>">
                <?=$msg_social['message']?>
            </div>
            <?php endif; ?>

            <?php foreach($social_media as $s): ?>
                <div class="social-input">
                    <label for="sm-<?=$s['sm_id']?>"><img src="<?=URL?>/static/images/social/<?=$s['sm_icon']?>"></label>
                    <input type="text" placeholder="Enter your <?=$s['sm_name']?> account" name="sm[<?=$s['sm_id']?>]" value="<?=$social[$s['sm_id']]['us_name'] ?? ''?>" id="sm-<?=$s['sm_id']?>">
                </div>
            <?php endforeach;?>

            <div class="form-submit">
                <button>Update <i class="fas fa-arrow-right"></i></button>
            </div>
            <input type="hidden" name="s-s">
        </form>

    </div>
    
</div>

<script>
    const loadFile = function(event) {
        let output = document.getElementById('avatar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
        document.getElementById('image-change-btn').classList.remove('no-display');
    };
</script>

