<?php
namespace ypmFrontend;
use YpmPopup\Popup as backendPopup;
require_once(dirname(__FILE__).'/Popup.php');
require_once(dirname(__FILE__).'/PopupChecker.php');

class PopupIncluder extends Popup {

	public function includePopup() {

		$id = $this->getId();

		$isPublished = backendPopup::isPostPublished($id);

		if(!$isPublished) {
			return false;
		}

		$popupPostContent = get_post_field('post_content', $id);
		$popupData = backendPopup::getSavedData($id);
		$popupData['title'] = get_the_title($id);
		$this->setContent($popupPostContent);
		$this->setOptions($popupData);

		$checkerObj = new PopupChecker($this);
		if(!$checkerObj->isAllow()) {
			return false;
		}
		$this->passToManager();
	}

	private function passToManager() {

		require_once(dirname(__FILE__).'/IncludeManager.php');
		$managerObj = new IncludeManager();
		$managerObj->setIncluderObj($this);
		$managerObj->loadPopupToPage();
	}
}