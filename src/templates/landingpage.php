<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-height-viewport lbr-flex lbr-flex-vertical lbr-flex-space-between lbr-background-shapes">
    <?php includeTemplate("nav.php") ?>
    <div class="lbr-container lbr-padding-small">
        <p class="lbr-heading lbr-margin-0-top lbr-margin" style="font-size: 4rem; line-height: 0.97">The ultimate student messenger.</p>
        <p class="lbr-text-lead lbr-margin"><span style="color: #fc3e6b;">Allegro</span> Be Online. Be Together. Be Productive. </p>
        <a href="register" class="lbr-button lbr-button-primary">Sign Up Now</a>
        <a href="about" class="lbr-button lbr-button-default">Learn More</a>
    </div>
    <?php includeTemplate("footer.php") ?>
</div>
