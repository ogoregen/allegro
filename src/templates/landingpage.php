<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-height-viewport lbr-flex lbr-flex-vertical lbr-flex-space-between lbr-background-shapes">
    <?php includeTemplate("nav.php") ?>
    <div class="lbr-container lbr-padding-small">
        <p class="lbr-heading lbr-margin-0-top lbr-margin" style="font-size: 4rem; line-height: 0.97">The ultimate student messenger.</p>
<<<<<<< Updated upstream
        <p class="lbr-text-lead lbr-margin"><span style="color: #fc3e6b;">Allegro</span> ut ac mauris tristique, aliquet est sit amet, molestie nisi. Pellentesque eu hendrerit erat, a finibus nunc. Fusce eros odio, maximus eu consectetur vel, pellentesque id metus.</p>
<<<<<<< Updated upstream
        <a href="register" class="lbr-button lbr-button-primary">Sign Up Now</a>
        <a href="about" class="lbr-button lbr-button-default">Learn More</a>
=======

        <button class="lbr-button lbr-button-primary"><a href="/register">Sign Up Now</a></button>
        <button class="lbr-button">Learn More</button>
=======
        <p class="lbr-text-lead lbr-margin"><span style="color: #fc3e6b;">Allegro</span> Be Online. Be Together. Be Productive. </p>
        <a href="register" class="lbr-button lbr-button-primary">Sign Up Now</a>
        <a href="about" class="lbr-button lbr-button-default">Learn More</a>
>>>>>>> Stashed changes
>>>>>>> Stashed changes
    </div>
    <?php includeTemplate("footer.php") ?>
</div>