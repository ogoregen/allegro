<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>
<div class="lbr-height-viewport lbr-flex lbr-flex-vertical lbr-flex-space-between Ibr-background-shapes-6">
    <?php includeTemplate("nav.php") ?>
    <div class="lbr-container lbr-padding-small">
        <p class="lbr-heading lbr-margin-0-top lbr-margin" style="font-size: 4rem; line-height: 0.97">The ultimate student messenger.</p>
        <img src="\static\images\People.jpg" style="float: left; margin-right: 10px; margin-left: 10px; border: 10px; border-color: #fc3e6b; border-radius: 30px 30px 30px 30px;" width="250px"></img>
        <br>
        <p class="lbr-text-lead lbr-margin">You can easily find your friends and contact them. Especially during these days, you can do your project easily by using Allegro.</p>
        <img src="\static\images\student.jpg" style="float: right; margin-right: 10px; margin-left: 10px; border: 10px; border-color: #fc3e6b; border-radius: 30px 30px 30px 30px;" width="250px"></img>
        <br><br><p class="lbr-text-lead lbr-margin">You can be more productive as you can get answers from your friends and teachers instantly. You can see them whenever they are online or not.</p>
        <br><br><img src="\static\images\studying.jpg" style="float: left; margin-right: 10px; margin-left: 10px; border: 10px; border-color: #fc3e6b; border-radius: 30px 30px 30px 30px;" width="250px"></img>
        <br><br><p class="lbr-text-lead lbr-margin">Your private information is safe and stored as only you know it.</p>
		<br><br><br><br><br>
        <a href="register" class="lbr-button lbr-button-primary">Sign Up Now</a>
    </div>
    <?php includeTemplate("footer.php") ?>
</div>