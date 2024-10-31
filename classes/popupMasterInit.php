<?php
namespace YpmPopup;
class popupMasterInit {
	
	public function __construct() {

		$this->includeClasses();
		$this->init();
	}

	public function includeClasses() {

		require_once(YPM_POPUP_CLASSES_FRONTEND.'PopupIncluder.php');

		if(YPM_POPUP_PKG != YPM_POPUP_FREE) {
			require_once(YPM_POPUP_HELPERS.'ProHelper.php');
			require_once(YPM_POPUP_CLASSES.'ProShortcodes.php');
		}
		require_once(YPM_POPUP_CLASSES.'YpmFunctions.php');
		// WordPress Script include function integration
		require_once(YPM_POPUP_HELPERS.'ScriptsManager.php');
		require_once(YPM_POPUP_HELPERS.'TabBuilder.php');
		require_once(YPM_POPUP_CLASSES.'YpmMediaButton.php');
		// Popup maker main short code
		require_once(YPM_POPUP_CLASSES.'YpmShortcode.php');
		// popup maker sub post types short codes
		require_once(YPM_POPUP_CLASSES.'Shortcodes.php');
		require_once(YPM_POPUP_CLASSES.'PopupData.php');
		require_once(YPM_POPUP_CLASSES.'YpmSavePopup.php');
		require_once(YPM_POPUP_CLASSES.'YpmRegistration.php');
		require_once(YPM_POPUP_CLASSES.'Ajax.php');
		require_once(YPM_POPUP_CLASSES.'Header.php');
		require_once(YPM_POPUP_CLASSES.'Actions.php');
		require_once(YPM_POPUP_JS.'JsInluder.php');
		require_once(YPM_POPUP_CSS.'Style.php');
	}

	public function init() {

		$popupObj = new Actions();
	}
}