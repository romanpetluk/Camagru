<section class="form">
    <h3 class="form__title-text">Login</h3>
    <form class="form__field" action="/account/login" method="post">
        <div class="form__login">
            <p class="form__login-text">Login:</p>
            <input class="form__login-input" type="text" name="login" autofocus placeholder="Write your login...">
        </div>
        <div class="form__password">
            <p class="form__password-text">Password:</p>
            <input class="form__password-input" type="password" name="password" placeholder="Write your password...">
        </div>
        <div class="form__btns">
            <button class="form__btn" type="submit" name="enter">Login</button>
            <p>
                <a title="Press for restore your account" class="form__recovery" href="/account/recovery">Recovery</a>
            </p>
        </div>
    </form>
</section>