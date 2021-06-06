
<div class="lbr-height-viewport lbr-background-gradient lbr-flex lbr-flex-vertical">
    <nav class="lbr-background-default lbr-width-full lbr-padding-small">
        <div clas="lbr-container lbr-flex lbr-flex-space-between">
            <a>Allegro</a>
        </div>
    </nav>
    <div class="lbr-container-small lbr-flex lbr-flex-middle lbr-flex-vertical lbr-flex-center lbr-flex-expand">
        <?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-margin lbr-alert lbr-alert-error">
                <p><?= $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <div class="lbr-section lbr-width-full">
            <h1 class="lbr-margin-0-top lbr-margin">Log In</h1>
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-label" for="user">Username or Email</label>
                <input name="user" type="text" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="user" value="<?= $context["autofill"]["user"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="password">Password</label>
                <input name="password" type="password" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="password" required>
            </div>
            <button class="lbr-button lbr-button-primary lbr-margin-small" type="submit">Log In</button>
            <p class="lbr-margin-0-bottom">Don't have an account? <a href="/register">Sign up</a>.</p>
            <p class="lbr-margin-0-bottom">Forgot your password? <a href="/resetpassword">Reset password</a>.</p>
        </form>
    </div>
</div>

<script src="static/js/utils.js"></script>
