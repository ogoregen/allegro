<?php
include "components/composemodal.php";
include "components/notificationmodal.php";
?>
<div style="height: 100vh; padding: 16px; background: linear-gradient(to left, #606c88, #3f4c6b)">

    <div class="lbr-background-default" style="width: 90%; height: 100%; margin: 0 auto; border-radius: 8px 8px 0px 8px; display: flex; flex-direction: column;">
        <div style="display: flex; background-color: aliceblue; border-radius: 8px 8px 0 0;">
            <a class="lbr-border-bottom lbr-text-logo" style="padding: 8px 24px;">Allegro</a>
            <div class="lbr-border-bottom lbr-flex-expand">
            </div>
            <div class="lbr-menu lbr-flex">
                <button><i class="fas fa-envelope-open-text lbr-margin-small-right"></i>Messages</button>
                <button><i class="fas fa-users lbr-margin-small-right"></i>People</button>
                <button class="active"><i class="fas fa-cog lbr-margin-small-right"></i>Settings</button>
            </div>
        </div>
        <div class="lbr-flex" style="height: 100%; flex-grow: 1;">
        <div style="width: 250px; height: 100%; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue; z-index: 1;">
                <div class="lbr-border-right" style="padding: 24px;">
                </div>
                <div class="lbr-tab-vertical-dashed">
                    <button class=" active" style="width: 100%; text-align: left"><i class="fas fa-inbox lbr-margin-small-right"></i>Account Details</button>
                    <button style="width: 100%; text-align: left"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Security</button>
                    <button style="width: 100%; text-align: left"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Communication</button>
                </div>

                <div class="lbr-border-right"style=" flex-grow: 1">
                
                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
            <div class="lbr-padding">
        <h1>Account Settings</h1>
            <h2>Account Information</h2>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Full Name</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Username</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Email Address</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
            </div>
            <button class="lbr-button lbr-button-primary" type="submit">Save</button>
            <h2>Password</h2>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Current Password</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="name">New Password</label>
                <input class="lbr-input lbr-width-full" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
                <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Show password</label>
            </div>
            <button class="lbr-button lbr-button-primary" type="submit">Change password</button>
            <h2>Email Preferences</h2>
            <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Receive notification emails.</label>            
            <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Do not show my email on my profile.</label>            
            <button class="lbr-button lbr-button-primary" type="submit">Save</button>
        </div>
    </div>
</div>
</div>
