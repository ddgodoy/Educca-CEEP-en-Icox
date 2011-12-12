<?php

/**
 * Rollover helper, 16/08/07
 * Autor: Todor Blajev
 * @version $Id$
 * @copyright 2007
 */

function rollover($link, $normal, $hover, $target_id, $etiqueta)
{
	return link_to(image_tag($normal, array('id' =>$target_id, 'title' => $etiqueta, 'alt' => $etiqueta)), $link, array(
			'onmouseover' => "rollover('".$target_id."', '".image_path($hover)."');",
			'onmouseout' => "rollover('".$target_id."', '".image_path($normal)."');"
		));
}

?>
