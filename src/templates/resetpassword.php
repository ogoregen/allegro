<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

?>

<?php include "components/notificationmodal.php" ?>

<div class="lbr-height-viewport lbr-flex lbr-flex-vertical lbr-background-shapes-6">
    <?php includeTemplate("nav.php") ?>

    <div class="lbr-container-small lbr-flex lbr-flex-middle lbr-flex-vertical lbr-flex-center lbr-flex-expand">
        <?php if (isset($context["errors"]["form"])) : ?>
            <div class="lbr-margin lbr-alert lbr-alert-error">
                <p><?= $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <div class="lbr-section lbr-width-full lbr-border">
            <h1 class="lbr-margin-0-top lbr-margin">Reset password</h1>
            <form action="" method="POST">
                <div class="lbr-margin">
                    <label class="lbr-label" for="password">New password</label>
                    <input name="password" type="password" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="password" autofocus required>
                    <?php if (isset($context["errors"]["password"])) : ?>
                        <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["password"] ?></div>
                    <?php endif ?>
                </div>

                <button class="lbr-button lbr-button-default lbr-margin-small" type="submit">Reset password</button>
            </form>
        </div>
    </div>
</div>