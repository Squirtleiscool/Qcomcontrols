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

class roboGalleryFieldsView{

	public function render($template, array $vars = array()){

		$templatePath = ROBO_GALLERY_FIELDS_TEMPLATE . $template . '.tpl.php';

		if (!file_exists($templatePath)) {
			throw new Exception(__("Could not find template. Template: {$template}"));
		}
		extract($vars);
		require $templatePath;
	}

	public function content($template, array $vars = array()){
		ob_start();
		$this->render($template, $vars);
		$content = ob_get_contents();
		ob_clean();

		return $content;
	}
}
