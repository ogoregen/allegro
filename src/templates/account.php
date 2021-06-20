<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport" style="border-radius: 8px 8px 0px 8px;">
    
    <?php 
    include "components/notificationmodal.php";
    includeTemplate("nav_app.php", ["current" => "account"]);
    ?>

    <div class="lbr-flex lbr-flex-expand " style="max-height: calc(100% - 52px);">
        <div style="min-width: 250px; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
        <div class="lbr-border-right" style="padding: 24px;">
                <div class="lbr-border lbr-border-radius lbr-padding-small lbr-flex lbr-flex-space-between lbr-flex-middle">
                <div>
                    <div><?= $_SESSION["user"]->fullName() ?></div>
                    <div><i class="fas fa-book-open lbr-text-success"></i> Online</div>
                </div>
                    
                    <a class="fas fa-sign-out-alt"></a>
                </div>
            </div>
            <div class="lbr-tab-vertical-dashed">
                <a href="?tab=details" class="<?= $context["tab"] == "details" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-user lbr-margin-small-right"></i>Account Details</a>
                <a href="?tab=security" class="<?= $context["tab"] == "security" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-lock lbr-margin-small-right"></i>Security</a>
                <a href="?tab=privacy" class="<?= $context["tab"] == "privacy" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-bell lbr-margin-small-right"></i>Communication</a>
                <a href="?tab=communication" class="<?= $context["tab"] == "communication" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-key lbr-margin-small-right"></i>Privacy</a>
            </div>

            <div class="lbr-border-right" style=" flex-grow: 1">
            
            </div>
            <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
            </div>
        </div>
        <div class="lbr-padding lbr-container-medium">
            
            <?php if($context["tab"] == "security"): ?>
                <h2>Change Password</h2>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Current Password</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">New Password</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" required>
                <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Show password</label>
            </div>
            <button class="lbr-button lbr-button-default" type="submit">Update</button>

            <?php elseif($context["tab"] == "communication"): ?>
                <h2>Privacy</h2>
            <label class="lbr-label lbr-margin-small"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Receive notification emails.</label>            
            <label class="lbr-label lbr-margin-small"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Do not show my email on my profile.</label>            
            <div class="lbr-margin">
                <button class="lbr-button lbr-button-default" type="submit">Update</button>
            </div>
            <?php elseif($context["tab"] == "privacy"): ?>
                <h2>Communication Preferences</h2>
            <label class="lbr-label lbr-margin-small"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Show my email address on classmates page.</label>            
            <label class="lbr-label lbr-margin-small"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Show me online when I am here.</label>            
            <div class="lbr-margin">
                <button class="lbr-button lbr-button-default" type="submit">Update</button>     
            </div>
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
                        <label class="lbr-label" for="email">Email Address</label>
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