<section class="profile">
    <h2 class="profile__title-text">PROFILE</h2>
    <form class="profile__field" action="/account/profile" method="post">
        <div class="profile__login">
            <p>Login</p>
            <input class="profile__login-input" type="text" value="<?php echo $_SESSION['account']['login']; ?>" name="login">
        </div>
        <div class="profile__email">
            <p>Email</p>
            <input class="profile__email-input" type="text" value="<?php echo $_SESSION['account']['email']; ?>" name="email">
        </div>
        <div class="profile__password">
            <p>Password</p>
            <input class="profile__password-input" type="password" name="password">
        </div>
        <div class="profile__notify-input">
        <?php if ($_SESSION['account']['notify']): ?>
            <p>Notify<p><input class="profile__login-input" type="checkbox" name="notify" value="1" checked>
        <?php else: ?>
            <p>Notify</p><input class="profile__login-input" type="checkbox" name="notify" value="0">
        <?php endif; ?>
        </div>
        <button class="profile__btn" type="submit">Save</button>
    </form>
</section>