<?php

/**
 * Functions for interacting with templates
 */

namespace Allegro\Core\template;

/**
 * Render template extending base template, passing variables. For use in views.
 * 
 * @param string $template File name of the template (in templates/)
 * @param array $context Variables to be passed to the template
 */
function render($template, $context = []){

    include "../templates/base.php";
}
