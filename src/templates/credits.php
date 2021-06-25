<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-flex lbr-flex-vertical lbr-flex-space-between lbr-height-viewport lbr-background-shapes-4">
    <div>
    <?php includeTemplate("nav.php") ?>
    <div class="lbr-container-medium lbr-flex lbr-flex-middle lbr-flex-center lbr-flex-expand lbr-flex-vertical lbr-margin lbr-margin-0-bottom">
        <div class="lbr-section lbr-width-full lbr-border">
            <h1 class="lbr-margin-0-top">Credits</h1>
            <p>Allegro was developed by Berfin Sünncetcioğlu, Fatma Kara, and Oğuzhan Göregen as part of CEIT133 course.</p>
            <p>It uses <a href="https://www.theleagueofmoveabletype.com/league-spartan">League Spartan</a> and <a href="https://manropefont.com">Manrope</a> fonts, background images from <a href="https://bgjar.com">BGJar</a>, icons from <a href="https://fontawesome.com">Font Awesome</a>, and mockup images from <a href="https://smartmockups.com">Smartmockups</a>.</p>
        </div>
    </div>
    </div>
    <?php includeTemplate("footer.php", ["current" => "credits"]) ?>
</div>
