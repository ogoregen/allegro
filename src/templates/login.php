<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-background-shapes-2 lbr-height-viewport lbr-flex lbr-flex-vertical">
    <?php includeTemplate("nav.php", ["noLoginButton" => true]) ?>
    <div class="lbr-container-small lbr-flex lbr-flex-middle lbr-flex-vertical lbr-flex-center lbr-flex-expand">
        <?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-margin lbr-alert lbr-width-full lbr-alert-error">
                <p><?= $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <div class="lbr-section lbr-width-full lbr-border">
            <h1 class="lbr-margin-0-top ">Log In</h1>
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-label" for="user">Username or Email</label>
                <input name="user" type="text" class="lbr-input lbr-width-full" id="user" value="<?= $context["autofill"]["user"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="password">Password</label>
                <input name="password" type="password" class="lbr-input lbr-width-full" id="password" required>
            </div>
            <button class="lbr-button lbr-button-primary lbr-margin-small" type="submit">Log In</button>
        </form>
        <p class="lbr-margin-0-bottom lbr-text-center">Don't have an account? <a href="/register">Sign up</a>.</p>
        <p class="lbr-margin-0-bottom lbr-text-center"><a href="/resetpassword">Forgot your password?</a></p>
    </div>
</div>
<script src="static/js/utils.js"></script>
