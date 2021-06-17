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

/**
 * Render template extending base template, passing variables, into a string.
 * 
 * Useful for filling mail templates.
 * 
 * @param string $template File name of the template (in templates/)
 * @param array $context Variables to be passed to the template
 */
function renderToString($template, $context = []){

	ob_start();
	include "../templates/".$template;
	$result = ob_get_contents();
	ob_end_clean();
	return $result;
}

/**
 * Render template passing variables. For use in templates.
 * 
 * @param string $template File name of the template (in templates/components/)
 * @param array $context Variables to be passed to the template
 */
function includeTemplate($template, $context = []){

	include "../templates/components/$template";
}
