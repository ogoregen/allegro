<div class="lbr-flex lbr-flex-center lbr-flex-column lbr-flex-middle lbr-padding">
<?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-alert lbr-alert-error">
                <p><?php echo $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>    
<div class="lbr-section">
        <h1 class="lbr-margin-0-top">Log In</h1>

        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-form-label" for="user">Email or username</label>
                <input name="user" type="text" class="lbr-input lbr-width-1-1" id="user" value="<?= $context["autofill"]["user"] ?? "" ?>" autofocus required>
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="password">Password</label>
                <input name="password" type="password" class="lbr-input lbr-width-1-1" id="password" required>
            </div>
            <button class="lbr-button lbr-button-default" type="submit">Log In</button>
            <p class="lbr-margin-bottom-0">Don't have an account? <a href="/register">Sign up</a>.</p>
        </form>
    </div>
</div>