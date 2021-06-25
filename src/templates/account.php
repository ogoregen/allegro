<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

include "components/notificationmodal.php";

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport lbr-padding lbr-background-shapes-gradient">

    <div class="lbr-border-radius lbr-container-large lbr-background-default" style="height: calc(100vh - 24px);">
        <?php includeTemplate("nav_app.php", ["current" => "account"]) ?>
        <div class="lbr-flex" style="height: calc(100% - 62px);">
            <div style="min-width: 250px; max-width: 250px; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
                <div class="lbr-border-right" style="padding: 24px;">
                    <div class="lbr-border lbr-border-radius lbr-padding-small lbr-flex lbr-flex-space-between lbr-flex-middle" style="min-height: 48px;">
                        <div class="lbr-flex lbr-flex-middle">
                            <?php if ($_SESSION["user"]->displayOnline): ?>
                                <i class="fas fa-book-open lbr-text-success"></i>
                            <?php else: ?>
                                <i class="fas fa-book"></i>
                            <?php endif ?>
                            <span class="lbr-margin-small-left"><?= $_SESSION["user"]->firstName ?></span>
                        </div>
                        <a href="logout" class="lbr-link-icon fas fa-sign-out-alt"></a>
                    </div>
                </div>
                <div class="lbr-tab-vertical-dashed">
                    <a href="?tab=details" class="<?= $context["tab"] == "details" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-user lbr-margin-small-right"></i>Account Details</a>
                    <a href="?tab=security" class="<?= $context["tab"] == "security" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-lock lbr-margin-small-right"></i>Security</a>
                    <a href="?tab=privacy" class="<?= $context["tab"] == "privacy" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-key lbr-margin-small-right"></i>Privacy</a>
                    <a href="?tab=communication" class="<?= $context["tab"] == "communication" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-bell lbr-margin-small-right"></i>Communication</a>
                </div>
                <div class="lbr-border-right" style=" flex-grow: 1">
                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a href="support" class="lbr-link-text "><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
            <div class="lbr-padding lbr-container-medium">
                <?php if ($context["tab"] == "security"): ?>
                    <h2>Change Password</h2>
                    <form action="" method="POST">
                        <div class="lbr-margin">
                            <label class="lbr-label" for="password">Current Password</label>
                            <input class="lbr-input lbr-width-full" name="password" type="password" required>
                            <?= $context["errors"]["password"] ?? "" ?>
                        </div>
                        <div class="lbr-margin">
                            <label class="lbr-label" for="newPassword">New Password</label>
                            <input class="lbr-input lbr-width-full" name="newPassword" type="password" id="newPassword" required>
                            <?= $context["errors"]["newPassword"] ?? "" ?>
                            <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('newPassword'));"> Show password</label>
                        </div>
                        <button name="button" value="password" class="lbr-button lbr-button-default" type="submit">Update</button>
                    </form>
                <?php elseif ($context["tab"] == "privacy"): ?>
                    <h2>Privacy</h2>
                    <form action="" method="POST">
                        <label class="lbr-label lbr-margin-small"><input name="displayEmail" type="checkbox" value="1" class="lbr-checkbox" <?= $_SESSION["user"]->displayEmail ? "checked" : "" ?>> Show my email address on classmates page.</label>
                        <label class="lbr-label lbr-margin-small"><input name="displayOnline" type="checkbox" value="1" class="lbr-checkbox" <?= $_SESSION["user"]->displayOnline ? "checked" : "" ?>> Show me online when I am using Allegro.</label>
                        <div class="lbr-margin">
                            <button name="button" value="privacy" class="lbr-button lbr-button-default" type="submit">Update</button>
                        </div>
                    </form>
                <?php elseif ($context["tab"] == "communication"): ?>
                    <h2>Communication Settings</h2>
                    <form action="" method="POST">
                        <label class="lbr-label lbr-margin-small"><input name="emailNotify" type="checkbox" value="1" class="lbr-checkbox" <?= $_SESSION["user"]->emailNotify ? "checked" : "" ?>> Receive notification emails.</label>
                        <label class="lbr-label lbr-margin-small"><input name="emailInform" type="checkbox" value="1" class="lbr-checkbox" <?= $_SESSION["user"]->emailInform ? "checked" : "" ?>> Inform me of new features and updated.</label>
                        <div class="lbr-margin">
                            <button name="button" value="communication" class="lbr-button lbr-button-default" type="submit">Update</button>
                        </div>
                    </form>
                <?php else: ?>
                    <h2>Account Details</h2>
                    <form action="" method="POST">
                        <div class="lbr-margin">
                            <label class="lbr-label" for="name">Full Name</label>
                            <input class="lbr-input lbr-width-full" name="name" type="text" value="<?= $context["autofill"]["name"] ?? "" ?>" required>
                            <?= $context["errors"]["name"] ?? "" ?>
                        </div>
                        <div class="lbr-margin">
                            <label class="lbr-label" for="username">Username</label>
                            <input class="lbr-input lbr-width-full" name="username" type="text" value="<?= $context["autofill"]["username"] ?? "" ?>" required>
                            <?= $context["errors"]["username"] ?? "" ?>
                        </div>
                        <div class="lbr-margin">
                            <label class="lbr-label" for="email">Email Address <span <?= $_SESSION["user"]->emailVerified ? "class='lbr-text-success'>(verified" : "class='lbr-text-warning'>(needs verification. <a href='requestverificationmail'>Click</a> to receive a new verification email." ?>)</span></label>
                            <input class="lbr-input lbr-width-full" name="email" type="email" value="<?= $context["autofill"]["email"] ?? "" ?>" required>
                            <?= $context["errors"]["email"] ?? "" ?>
                        </div>
                        <div class="lbr-margin">
                            <button class="lbr-button lbr-button-default" name="button" value="details" type="submit">Update</button>
                        </div>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>