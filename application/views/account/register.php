<section class="register">
    <h3 class="register__title-text">Register</h3>
    <form class="register__field" action="/account/register" method="post">
        <div class="register__email">
            <p>Email:</p>
            <input class="register__email-input" type="email" name="email" autofocus placeholder="Write email" required>
        </div>
        <div class="register__login">
            <p>Login:</p>
            <input class="register__login-input" type="text" name="login" placeholder="Write login" required minlength="3" maxlength="15">
        </div>
        <div class="register__password">
            <p>Password:</p>
            <input class="register__password-input" type="password" name="password" placeholder="Write password" required minlength="6" maxlength="20">
        </div>
        <button class="register__btn" type="submit" name="enter">Register</button>
    </form>
</section>