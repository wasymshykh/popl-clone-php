<div class="register-page">

    <div class="page-title">
        <h1>Join</h1>
        <p>Create a new <strong><?=$settings->get_all()['site_title']?></strong> account</p>
    </div>

    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" class="page-form">
        <?php if ($msg): ?>
        <div class="form-message form-<?=$msg['type']?>">
            <?=$msg['message']?>
        </div>
        <?php endif; ?>
        <div class="form-input">
            <label for="inp-name">Write <b>Name</b></label>
            <input type="text" name="name" id="inp-name" placeholder="e.g. anas" value="<?=$_POST['name'] ?? ''?>" required>
        </div>
        <div class="form-input">
            <label for="inp-email">Write <b>Email</b></label>
            <input type="email" name="email" id="inp-email" placeholder="e.g. test@test.com" value="<?=$_POST['email'] ?? ''?>" required>
        </div>
        <div class="form-input">
            <label for="inp-password">Write <b>Password</b></label>
            <input type="password" name="password" id="inp-password" placeholder="" required>
        </div>
        <div class="form-submit">
            <button>Submit <i class="fas fa-arrow-right"></i></button>
        </div>
    </form>

</div>
