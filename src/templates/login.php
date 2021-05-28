<div class="lbr-flex lbr-flex-center lbr-flex-column lbr-flex-middle lbr-padding">
    <div class="lbr-section lbr-width-1-4">
        <h1 style="margin-top: 0;">Log In</h1>
        <?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-alert lbr-alert-error">
                <p><?php echo $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-form-label" for="email">E-Mail Address</label>
                <input class="lbr-input lbr-width-1-1" name="email" type="email" id="email" value="<?php echo $context["autofill"]["email"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="password">Password</label>
                <input class="lbr-input lbr-width-1-1" name="password" type="password" id="password" required>
            </div>
            <button class="lbr-button lbr-button-default" type="submit">Log In</button>
            <p class="lbr-margin-bottom-0">Don't have an account? <a href="/register">Sign up</a>.</p>
        </form>
    </div>
</div>