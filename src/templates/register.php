
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
                <label class="lbr-form-label" for="email">E-Mail Address</label>
                <input class="lbr-input lbr-width-1-1 <?php if(isset($context["errors"]["email"])) echo 'lbr-form-error' ?>" name="email" type="email" id="email" value="<?php echo $context["autofill"]["email"] ?? "" ?>" required>
                <?php renderFieldError($context["errors"]["email"] ?? null) ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="password">Password</label>
                <input class="lbr-input lbr-width-1-1" name="password" type="password" id="password" minlength="8" required>
                <?php renderFieldError($context["errors"]["password"] ?? null) ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="passwordConfirmation">Password, again</label>
                <input class="lbr-input lbr-width-1-1" name="passwordConfirmation" type="password" id="passwordConfirmation" minlength="8" required>
                <?php renderFieldError($context["errors"]["passwordConfirmation"] ?? null) ?>
            </div>
            <button class="lbr-button lbr-button-default" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<?php 

function renderFieldError($message){

    if(isset($message)) echo "<p class='lbr-text-error lbr-margin-0'>$message</p>";
}

?>
