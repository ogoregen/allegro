<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-height-viewport lbr-flex lbr-flex-vertical lbr-background-shapes-3">
    <?php includeTemplate("nav.php", ["noRegisterButton" => true]) ?>
    <div class="lbr-container-small lbr-flex lbr-flex-middle lbr-flex-center lbr-flex-expand lbr-flex-vertical">
        <?php if (isset($context["errors"]["form"])) : ?>
            <div class="lbr-margin lbr-alert lbr-alert-error">
                <p><?= $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <div class="lbr-section lbr-width-full lbr-border">
            <h1 class="lbr-margin-0-top">Sign Up</h1>
            <form action="" method="POST">
                <div class="lbr-margin">
                    <label class="lbr-label" for="name">Full Name</label>
                    <input name="name" type="text" class="lbr-input lbr-width-full" id="name" value="<?= $context["autofill"]["name"] ?? "" ?>" autofocus required>
                    <?php if (isset($context["errors"]["name"])) : ?>
                        <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["name"] ?></div>
                    <?php endif ?>
                </div>
                <div class="lbr-margin">
                    <label class="lbr-label" for="username">Username</label>
                    <input name="username" type="text" class="lbr-input lbr-width-full" id="username" value="<?= $context["autofill"]["username"] ?? "" ?>" required>
                    <?php if (isset($context["errors"]["username"])) : ?>
                        <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["username"] ?></div>
                    <?php endif ?>
                </div>
                <div class="lbr-margin">
                    <label class="lbr-label" for="email">E-Mail Address</label>
                    <input name="email" type="email" class="lbr-input lbr-width-full" id="email" value="<?= $context["autofill"]["email"] ?? "" ?>" required>
                    <?php if (isset($context["errors"]["email"])) : ?>
                        <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["email"] ?></div>
                    <?php endif ?>
                </div>
                <div class="lbr-margin">
                    <label class="lbr-label" for="password">Password</label>
                    <input name="password" type="password" class="lbr-input lbr-width-full" id="password" minlength="8" required>
                    <label class="lbr-label lbr-margin" onselectstart="return false"><input type="checkbox" class="lbr-margin-0-left" onclick="toggleInputVisibility(document.getElementById('password'));"> Show password</label>
                    <?php if (isset($context["errors"]["password"])) : ?>
                        <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["password"] ?></div>
                    <?php endif ?>
                </div>
                <button class="lbr-button lbr-button-primary lbr-margin-small" type="submit">Sign Up</button>
            </form>
            <p class="lbr-margin-0-bottom lbr-text-center">Already have an account? <a href="/login">Log in</a>.</p>
        </div>
    </div>
</div>