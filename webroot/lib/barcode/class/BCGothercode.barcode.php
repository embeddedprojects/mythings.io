<?php
/**
 * BCGothercode.barcode.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - othercode
 *
 * Other Codes
 * Starting with a bar and altern to space, bar, ...
 * 0 is the smallest
 *
 *--------------------------------------------------------------------
 * Revision History
 * v2.00	23 apr	2008	Jean-Sébastien Goupil	New Version Update
 * v1.2.3b	2  jan	2006	Jean-Sébastien Goupil	Correct error if $textfont was empty
 * v1.2.1	27 jun	2005	Jean-Sébastien Goupil	Font support added
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * $Id: BCGothercode.barcode.php,v 1.8 2008/07/10 04:23:25 jsgoupil Exp $
 * PHP5-Revision: 1.8
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
include_once('BCGBarcode1D.php');

// Function str_split is not available for PHP4. So we emulate it here.
if (!function_exists('str_split')) {
	function str_split($string, $split_length = 1) {
		$array = explode("\r\n", chunk_split($string, $split_length));
		array_pop($array);
		return $array;
	}
}

class BCGothercode extends BCGBarcode1D {
	/**
	 * Constructor
	 */
	function BCGothercode() {
		BCGBarcode1D::BCGBarcode1D();
	}

	/**
	 * Draws the barcode
	 *
	 * @param resource $im
	 */
	function draw(&$im) {
		$this->drawChar($im, $this->text, true);
		$this->drawText($im);
	}

	function getLabel() {
		$label = $this->label;
		if($this->label === $this->AUTO_LABEL) {
			$label = '';
		}

		return $label;
	}

	/**
	 * Returns the maximal size of a barcode
	 *
	 * @return int[]
	 */
	function getMaxSize() {
		$p = BCGBarcode1D::getMaxSize();

		$array = str_split($this->text, 1);
		$textlength = (array_sum($array) + count($array)) * $this->scale;

		return array($p[0] + $textlength, $p[1]);
	}

	/**
	 * Overloaded method for drawing special label
	 *
	 * @param resource $im
	 */
	function drawText(&$im) {
		if($this->label !== $this->AUTO_LABEL && $this->label !== '') {
			$pA = $this->getMaxSize();
			$pB = BCGBarcode1D::getMaxSize();
			$w =  $pA[0] - $pB[0];

			if(is_a($this->textfont, 'BCGFont')) {
				$textfont = $this->textfont; // clone
				$textfont->setText($this->label);

				$xPosition = ($w / 2) - $textfont->getWidth() / 2 + $this->offsetX * $this->scale;
				$yPosition = $this->thickness * $this->scale + $textfont->getHeight() - $textfont->getUnderBaseline() + BCGBarcode1D::SIZE_SPACING_FONT + $this->offsetY * $this->scale;

				$text_color = $this->colorFg->allocate($im);
				$textfont->draw($im, $text_color, $xPosition, $yPosition);
			} elseif($this->textfont !== 0) {
				$xPosition = ($w / 2) - (strlen($this->label) * imagefontwidth($this->textfont)) / 2 + $this->offsetX * $this->scale;
				$yPosition = $this->thickness * $this->scale + $this->offsetY * $this->scale + BCGBarcode1D::SIZE_SPACING_FONT;

				$text_color = $this->colorFg->allocate($im);
				imagestring($im, $this->textfont, $xPosition, $yPosition, $this->label, $text_color);
			}
		}
	}
};
?>