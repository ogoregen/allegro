<nav class="lbr-nav">
    <div class="lbr-container-medium lbr-flex lbr-flex-space-between lbr-flex-middle">
        <a href="/" class="lbr-text-logo">Allegro</a>
        <div class="lbr-flex">
            <?php if (!($_SESSION["isAuthenticated"] ?? false)) : ?>
                <?php if (!($context["noRegisterButton"] ?? false)) : ?>
                    <a href="/register" class="lbr-button lbr-button-primary">Sign Up</a>
                <?php endif ?>
                <?php if (!($context["noLoginButton"] ?? false)) : ?>
                    <a href="/login" class="lbr-button lbr-button-default" style="margin-left: 4px">Log In</a>
                <?php endif ?>
            <?php else : ?>
                <a href="/dashboard" class="lbr-button lbr-button-default" style="margin-left: 4px">Dashboard</a>
            <?php endif ?>
        </div>
    </div>
</nav>