<div class="lbr-background-gradient lbr-height-viewport">
    <div class="lbr-container lbr-padding">
        <div class="lbr-border-radius lbr-border lbr-background-default lbr-padding">
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
            <button class="lbr-button lbr-button-default" type="submit">Save</button>
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
            <button class="lbr-button lbr-button-default" type="submit">Change password</button>
            <h2>Email Preferences</h2>
            <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Receive notification emails.</label>            
            <label class="lbr-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Do not show my email on my profile.</label>            
            <button class="lbr-button lbr-button-default" type="submit">Save</button>
        </div>
    </div>
</div>