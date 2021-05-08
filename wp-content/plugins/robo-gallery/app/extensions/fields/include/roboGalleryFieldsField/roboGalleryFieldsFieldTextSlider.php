<?php
/* 
*      Robo Gallery     
*      Version: 3.0.7 - 90614
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */

class roboGalleryFieldsFieldTextSlider extends roboGalleryFieldsField{

	protected function getDefaultOptions(){
		return array(
			'textBefore' => '',
			'textAfter' => '',
			'data-start' => 0,
			'data-end' => 100,
			'step' => 1
		);
	}

	protected function normalize($value){
		$min = isset($this->options['data-start']) ? $this->options['data-start'] : 0;
		$max = isset($this->options['data-end']) ? $this->options['data-end'] : 100;
		$step = isset($this->options['step']) ? absint($this->options['step']) : 1;

		$value = parent::normalize($value);

		if ($value < $min) {
			$value = $min;
		}
		if ($value > $max) {
			$value = $max;
		}
		if ($remainder = $value % $step) {
			$value = max($min, $value - $remainder);
		}

		return $value;
	}
}
