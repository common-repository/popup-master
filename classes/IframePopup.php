<?php
namespace YpmPopup;
require_once(dirname(__FILE__).'/Popup.php');

class IframePopup extends Popup {

	private $id;

	public function __construct() {

		wp_register_script('iframeJs', YPM_POPUP_JS_URL . '/iframe.js', array('jquery'));
		wp_enqueue_script('iframeJs');
	}

	public function setId($id) {

		$this->id = (int)$id;
	}

	public function getId() {

		return $this->id;
	}

	public static function create($data, $obj = '') {

		$obj = new self();
		parent::create($data, $obj);
	}

	public function getContent() {

		$id = $this->getId();
		$savedData = parent::getSavedData($id);

		$iframeUrl = $savedData['ypm-iframe-url'];
		$iframeWidth = $savedData['ypm-iframe-width'];
		$iframeHeight = $savedData['ypm-iframe-height'];

		$iframe = "<iframe src='$iframeUrl' width='$iframeWidth' height='$iframeHeight'></iframe>";

		return $iframe;
	}
}