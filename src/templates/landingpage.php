
<?php
require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;
?>

<div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;" class="lbr-background-shapes">
    <?php 
    includeTemplate("nav.php");
    ?>
    <div class="lbr-container">
        <p class="lbr-heading lbr-margin-0-top lbr-margin" style="font-size: 4rem; line-height: 0.97">The ultimate student messenger.</p>
        <p class="lbr-text-lead lbr-margin"><span style="color: #fc3e6b;">Allegro</span> ut ac mauris tristique, aliquet est sit amet, molestie nisi. Pellentesque eu hendrerit erat, a finibus nunc. Fusce eros odio, maximus eu consectetur vel, pellentesque id metus.</p>

        <a href="/register" class="lbr-button lbr-button-primary">Sign Up Now</a>
        <button class="lbr-button lbr-button-default">Learn More</button>
    </div>
    <footer class="lbr-nav" style="display: flex; align-items: center;">
        <div class="lbr-container-medium" style="display: flex; justify-content: space-between; align-items: center;">
            <p>© 2021 Allegro | <a href="/privacy">Privacy Policy</a> - <a href="/support">Support</a></p>
        </div>
    </footer>
</div>