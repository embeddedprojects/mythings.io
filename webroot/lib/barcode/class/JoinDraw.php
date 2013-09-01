<?php
/**
 * JoinDraw.php
 *--------------------------------------------------------------------
 *
 * Enable to join 2 BCGDrawing or 2 image object to make only one image.
 * There are some options for alignement.
 *
 * ! THIS CLASS IS NOT AVAILABLE FOR PHP4 !
 *
 *--------------------------------------------------------------------
 * Revision History
 * v2.0.1	09 mar	2009	Jean-Sébastien Goupil	Update for BCG classes
 * v1.2.3b	31 dec	2005	Jean-Sébastien Goupil
 *--------------------------------------------------------------------
 * $Id: JoinDraw.php,v 1.4 2009/03/08 23:12:27 jsgoupil Exp $
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
class JoinDraw {
	/**
	 * Construct the JoinDrawing Object.
	 *  - $image1 and $image2 have to be BCGDrawing object or image object.
	 *  - $space is the space between the two graphics in pixel.
	 *  - $position is the position of the $image2 depending the $image1.
	 *  - $alignment is the alignment of the $image2 if this one is smaller than $image1;
	 *    if $image2 is bigger than $image1, the $image1 will be positionned on the opposite side specified.
	 *
	 * @param mixed $image1
	 * @param mixed $image2
	 * @param BCGColor $background
	 * @param int space
	 * @param int $position
	 * @param int $alignment
	 */
	function JoinDraw(&$image1, &$image2, $background, $space = 10, $position = 0, $alignment = 0) {
	}

	/**
	 * Returns the new $im created.
	 *
	 * @return resource
	 */
	function get_im() {
		return false;
	}
}