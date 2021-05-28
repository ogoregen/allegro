<div class="lbr-height-viewport lbr-flex lbr-flex-center lbr-flex-middle lbr-padding">
    <div class="lbr-section lbr-width-1-4">
        <h1 style="margin-top: 0;">Sign Up</h1>
        <?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-alert lbr-alert-error">
                <p><?php echo $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-form-label" for="name">Full Name</label>
                <input class="lbr-input lbr-width-1-1" name="name" type="text" id="name" value="<?php echo $context["autofill"]["name"] ?? "" ?>" autofocus required>
                <?php renderFieldError($context["errors"]["name"] ?? null) ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="username">Username</label>
                <input class="lbr-input lbr-width-1-1" name="username" type="text" id="username" value="<?php echo $context["autofill"]["username"] ?? "" ?>" required>
                <?php renderFieldError($context["errors"]["username"] ?? null) ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="email">E-Mail Address</label>
                <input class="lbr-input lbr-width-1-1" name="email" type="email" id="email" value="<?php echo $context["autofill"]["email"] ?? "" ?>" required>
                <?php renderFieldError($context["errors"]["email"] ?? null) ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="password">Password</label>
                <input class="lbr-input lbr-width-1-1" name="password" type="password" id="password" minlength="8" required>
                <label class="lbr-form-label"><input class="lbr-checkbox" type="checkbox" onclick="toggleFieldVisibility(document.getElementById('password'));"> Show password</label>
                <?php renderFieldError($context["errors"]["password"] ?? null) ?>
            </div>
            <button class="lbr-button lbr-button-default" type="submit">Sign Up</button>
            <p class="lbr-margin-bottom-0">Already have an account? <a href="/login">Log in</a> instead.</p>
        </form>
    </div>
</div>

<script>

function toggleFieldVisibility(field){

    field.type = field.type == "password" ? "text" : "password";
}

</script>

<?php 

function renderFieldError($message){

    if(isset($message)) echo "<p class='lbr-text-error lbr-margin-0'>$message</p>";
}

?>