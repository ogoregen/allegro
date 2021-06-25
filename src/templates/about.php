<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

?>

<div class=" lbr-flex lbr-flex-vertical lbr-flex-space-between">
    <?php includeTemplate("nav.php") ?>
    <div class="lbr-container lbr-padding-small">
        <div style="animation: fadeIn linear 7s;
            -webkit-animation: fadeIn linear 2s;
            -moz-animation: fadeIn linear 2s;
            -o-animation: fadeIn linear 2s;
            -ms-animation: fadeIn linear 2s;">
            <h1 class="lbr-text-center">Welcome to Allegro.</h1>
            <div class="lbr-section lbr-background-b">
                <p class="lbr-text-large lbr-text-center">Allegro standardizes your classroom's out-of-class communication replacing hard to follow chat groups and unspecialized email.</p>
                <p class="lbr-text-large lbr-text-center">A no-nonsense messaging application where you will instantly feel familiar.</p>
            </div>
        </div>
    </div>
    <h2 class="lbr-text-large lbr-text-center">Features</h2>
    <div class="lbr-flex lbr-container-medium lbr-margin-auto-horizontal lbr-flex-middle" style="margin-bottom: 48px; left: 0; right: 0;">
        <img src="static/images/mockup-tablet.jpg" class="lbr-border-radius" height="350px">
        <p class="lbr-padding lbr-text-large lbr-text-center">Message formatting with Github flavoured Markdown.</p>
    </div>
    <div class="lbr-flex lbr-margin lbr-container-medium lbr-margin-auto-horizontal lbr-flex-middle" style="margin-bottom: 48px; left: 0; right: 0;">
        <p class="lbr-padding lbr-text-large lbr-text-center">A classroom dashboard with all of your peers together where you can see who is available, when.</p>
        <img src="static/images/mockup-classmates.jpg" class="lbr-border-radius" height="350px">
    </div>
    <div class="lbr-flex lbr-margin lbr-container-medium lbr-margin-auto-horizontal lbr-flex-middle" style="margin-bottom: 48px; left: 0; right: 0;">
        <img src="static/images/mockup-tablet.jpg" class="lbr-border-radius" height="350px">
        <p class="lbr-padding lbr-text-large lbr-text-center">Deletable messages. From the recipient's inbox, too.</p>
    </div>
    <div class="lbr-flex lbr-margin lbr-container-medium lbr-margin-auto-horizontal lbr-flex-middle" style="margin-bottom: 48px; left: 0; right: 0;">
        <p class="lbr-padding lbr-text-large lbr-text-center">Self-messaging. Communication with yourself, integrated.</p>
        <img src="static/images/mockup-tablet.jpg" class="lbr-border-radius" height="350px">
    </div>
    <div class="lbr-flex lbr-margin lbr-container-medium lbr-margin-auto-horizontal lbr-flex-middle" style="margin-bottom: 48px; left: 0; right: 0;">
        <img src="static/images/mockup-tablet.jpg" class="lbr-border-radius" height="350px">
        <p class="lbr-padding lbr-text-large lbr-text-center">Optional silent messages that don't create notifications for your recipient.</p>
    </div>
    <div class="lbr-container">
        <div class="lbr-section lbr-background-a">
            <p class="lbr-text-center lbr-text-large lbr-text-bold">Try Allegro now, for free.</p>
            <div class="lbr-flex lbr-flex-center">
                <a href="register" class="lbr-button lbr-button-primary">Sign Up</a>
            </div>
        </div>
    </div>
    <p class="lbr-padding lbr-text-large lbr-text-center">Want to learn more? Check <a href="support">FAQ.</a></p>
    <?php includeTemplate("footer.php") ?>
</div>