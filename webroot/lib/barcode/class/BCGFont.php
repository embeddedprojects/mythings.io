<?php
/**
 * BCGFont.php
 *--------------------------------------------------------------------
 *
 * Holds font family and size.
 *
 *--------------------------------------------------------------------
 * Revision History
 * v2.00	23 apr	2008	Jean-Sébastien Goupil	New Version Update
 * v1.2.3	6  feb	2006	Jean-Sébastien Goupil	Correct getWidth()
 * v1.2.3b	30 dec	2005	Jean-Sébastien Goupil	Add getUnderBaseline()
 * V1.2.1	27 jun	2005	Jean-Sebastien Goupil	New
 *--------------------------------------------------------------------
 * $Id: BCGFont.php,v 1.5 2008/07/10 04:23:25 jsgoupil Exp $
 * PHP5-Revision: 1.5
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
class BCGFont {
	var $path;
	var $text;
	var $size;
	var $box;

	/**
	 * Constructor
	 *
	 * @param string $fontPath path to the file
	 * @param int $size size in point
	 */
	function BCGFont($fontPath, $size) {
		$this->path = $fontPath;
		$this->size = $size;
	}

	/**
	 * Text associated to the font
	 *
	 * @param string text
	 */
	function setText($text) {
		$this->text = $text;
		$im = imagecreate(1, 1);
		$this->box = imagettftext($im, $this->size, 0, 0, 0, imagecolorallocate($im, 0, 0, 0), $this->path, $this->text);
	}

	/**
	 * Returns the width that the text takes to be written
	 *
	 * @return float
	 */
	function getWidth() {
		if ($this->box !== NULL) {
			// Bug fixed : a number is aligned on the "right" in the box...
			// If we are writting the number "1" with minX at 2 and maxX at 10
			// The maxWidth will be 10 and not 8 because we don't squeeze the number
			// on its left. So now we don't remove the minX.
			return abs(max($this->box[2], $this->box[4]));
		} else {
			return 0;
		}
	}

	/**
	 * Returns the height that the text takes.
	 *
	 * @return float
	 */
	function getHeight() {
		if ($this->box !== NULL) {
			return (float) abs(max($this->box[5], $this->box[7]) - min($this->box[1], $this->box[3]));
		} else {
			return 0.0;
		}
	}

	/**
	 * Returns the number of pixel under the baseline located at 0.
	 *
	 * @return float
	 */
	function getUnderBaseline() {
		// Y for imagettftext : This sets the position of the fonts baseline, not the very bottom of the character.
		return (float) max($this->box[1], $this->box[3]);
	}

	/**
	 * Draws the text on the image at a specific position.
	 * $x and $y represent the left bottom corner.
	 *
	 * @param resource $im
	 * @param int $color
	 * @param int $x
	 * @param int $y
	 */
	function draw(&$im, $color, $x, $y) {
		imagettftext($im, $this->size, 0, $x, $y, $color, $this->path, $this->text);
	}
}
?>