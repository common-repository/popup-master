<?php
namespace YpmPopup;
class Shortcodes{

	public function __construct() {

		$this->init();
	}

	public function init() {

		add_shortcode('ypm_facebook', array($this, 'ypmFbShortCode'));
	}

	public function ypmFbShortCode($args, $content) {

		$id = (int)$args['id'];
		$isPublished = Popup::isPostPublished($id);

		if(!$isPublished) {
			return false;
		}

		require_once(YPM_POPUP_CLASSES.'FacebookPopup.php');
		$fbObj = new FacebookPopup();
		$fbObj->setFbId($id);


		return $fbObj->renderFbButtons();
	}
}

new Shortcodes();