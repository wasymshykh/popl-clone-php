
<div class="login-page">

    <div class="page-title">
        <h1>Login</h1>
        <p>Get authenticated to <strong><?=$settings->get_all()['site_title']?></strong> account</p>
    </div>


    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" class="page-form">
        <?php if ($msg): ?>
        <div class="form-message form-<?=$msg['type']?>">
            <?=$msg['message']?>
        </div>
        <?php endif; ?>
        <div class="form-input">
            <label for="inp-email">Enter <b>Email</b></label>
            <input type="email" name="email" id="inp-email" placeholder="e.g. test@test.com" value="<?=$_POST['email'] ?? ''?>" required>
        </div>
        <div class="form-input">
            <label for="inp-password">Enter <b>Password</b></label>
            <input type="password" name="password" id="inp-password" placeholder="" required>
        </div>
        <div class="form-check">
            <input type="checkbox" name="remember" id="inp-remember">
            <label for="inp-remember">stay logged in?</label>
        </div>
        <div class="form-submit">
            <button>Login <i class="fas fa-arrow-right"></i></button>
        </div>
    </form>

</div>