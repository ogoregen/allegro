
<div class="lbr-height-viewport lbr-background-gradient lbr-flex lbr-flex-vertical">
    <nav class="lbr-background-default lbr-width-full lbr-padding-small">
        <div clas="lbr-container lbr-flex lbr-flex-space-between">
            <a class="lbr-border-bottom lbr-text-logo" style="padding: 8px 24px;">Allegro</a>
        </div>
    </nav>
    <div class="lbr-container-small lbr-flex lbr-flex-middle lbr-flex-center lbr-flex-expand">
        <?php if(isset($context["errors"]["form"])): ?>
            <div class="lbr-margin lbr-alert lbr-alert-error">
                <p><?= $context["errors"]["form"] ?></p>
            </div>
        <?php endif ?>
        <div class="lbr-section lbr-width-full">
            <h1 class="lbr-margin-0-top lbr-margin">Sign Up</h1>
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-label" for="name">Full Name</label>
                <input name="name" type="text" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="name" value="<?= $context["autofill"]["name"] ?? "" ?>" autofocus required>
                <?php if(isset($context["errors"]["name"])): ?>
                    <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["name"] ?></div>
                <?php endif ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="username">Username</label>
                <input name="username" type="text" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="username" value="<?= $context["autofill"]["username"] ?? "" ?>" required>
                <?php if(isset($context["errors"]["username"])): ?>
                    <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["username"] ?></div>
                <?php endif ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="email">E-Mail Address</label>
                <input name="email" type="email" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="email" value="<?= $context["autofill"]["email"] ?? "" ?>" required>
                <?php if(isset($context["errors"]["email"])): ?>
                    <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["email"] ?></div>
                <?php endif ?>
            </div>
            <div class="lbr-margin">
                <label class="lbr-label" for="password">Password</label>
                <input name="password" type="password" class="lbr-input lbr-width-full lbr-padding-small-vertical" id="password" minlength="8" required>
                <label class="lbr-label lbr-margin-small"><input type="checkbox" class="lbr-checkbox lbr-margin-0-left" onclick="toggleInputVisibility(document.getElementById('password'));"> Show password</label>
                <?php if(isset($context["errors"]["password"])): ?>
                    <div class="lbr-text-error lbr-margin-small"><?= $context["errors"]["password"] ?></div>
                <?php endif ?>
            </div>
            <button class="lbr-button lbr-button-primary lbr-margin-small" type="submit">Sign Up</button>
            <p class="lbr-margin-0-bottom">Already have an account? <a href="/login">Log in</a>.</p>
        </form>
    </div>
</div>

<script src="static/js/utils.js"></script>
