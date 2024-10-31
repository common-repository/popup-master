<?php
namespace ypmFrontend;

class IncludeManager {

	private $includerObj;

	public function setIncluderObj($includerObj) {
		$this->includerObj = $includerObj;
	}

	public function getIncluderObj() {
		return $this->includerObj;
	}

	public function loadPopupToPage() {
		$includerObj = $this->getIncluderObj();
		$id = $includerObj->getId();

		$this->includeScripts();
		$this->includeContent();
		if($includerObj->getLoadable()) {
			$this->openByJs($id);
		}
	}
	private function includeScripts() {

		wp_register_script('YpmPopup', YPM_POPUP_JS_URL.'YpmPopup.js');
		wp_register_script('YpmObserver', YPM_POPUP_JS_URL.'YpmObserver.js');
		wp_register_script('jquery.colorbox', YPM_POPUP_JS_URL.'jquery.colorbox.js');

		if(YPM_POPUP_PKG != YPM_POPUP_FREE) {
			wp_register_script('YpmExit', YPM_POPUP_JS_URL.'YpmExit.js', array('YpmPopup'));
			wp_enqueue_script("YpmExit");
		}

		wp_enqueue_script("YpmPopup");
		wp_enqueue_script("jquery.colorbox");
		wp_enqueue_script("YpmObserver");

		wp_register_style('ypmcolorbox', YPM_POPUP_CSS_URL."colorbox/colorbox.css");
		wp_enqueue_style('ypmcolorbox');
	}

	private function includeContent() {

		$includerObj = $this->getIncluderObj();
		$content = $includerObj->getContent();
		$id = $includerObj->getId();
		$options = $includerObj->getOptions();

		add_action('wp_footer', function() use ($content, $id, $options){
			$options = json_encode($options);
			echo "<script>YPM_DATA[$id] = $options;</script>";
			$popupContent = "<div style=\"display:none\"><div id=\"ypm-popup-content-wrapper-$id\">".$content."</div></div>";
			echo $popupContent;
		}, 1);
	}

	private function openByJs($id) {

		echo "<script>
			YPM_IDS.push($id);
		</script>";
	}
}