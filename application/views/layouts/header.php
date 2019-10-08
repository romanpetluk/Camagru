<header>

    <div class="header-container">
        <div class="logo">
            <img src="/public/images/logo.png" alt="logo" width="" height="150">
        </div>
        <input type="checkbox" id="menu-checkbox">
        <nav role="navigation">
            <label for="menu-checkbox" class="toggle-button" data-open="MENU" data-close="CLOSE" onclick></label>
            <ul class="main-menu">
                <li><a href="/photo/gallery/1">gallery</a></li>
                <?php if (isset($_SESSION['account']['user_id'])): ?>
                    <li><a href="/photo/selfie">selfie</a></li>
                    <li><a href="/account/profile">profile</a></li>
                    <li><a href="/account/logout">logout<?php echo ': ' . $_SESSION['account']['login']  ?></a></li>
                <?php else: ?>
                    <li><a href="/account/login">login</a></li>
                    <li><a href="/account/register">register</a></li>


                <?php endif; ?>
            </ul>
        </nav>
    </div>

</header>


