<?php
namespace YpmPopup;
class Style {

	public function __construct() {

		$this->init();
	}

	public function init() {

	}

	public static function enqueueStyles($hook) {

		global $post, $PostTypesInfo;

		if($hook == 'post-new.php' || $hook == 'post.php') {

			$popupPostTypes = $PostTypesInfo['postTypes'];

			if(!empty($popupPostTypes[$post->post_type])) {
				ScriptsManager::registerStyle('bootstrap.css');
				ScriptsManager::enqueueStyle('bootstrap.css');
				ScriptsManager::registerStyle('select2.css');
				ScriptsManager::enqueueStyle('select2.css');
				ScriptsManager::registerStyle('style.css');
				ScriptsManager::enqueueStyle('style.css');
				ScriptsManager::registerStyle('ion.rangeSlider.css');
				ScriptsManager::enqueueStyle('ion.rangeSlider.css');
				ScriptsManager::registerStyle('ion.rangeSlider.skinFlat.css');
				ScriptsManager::enqueueStyle('ion.rangeSlider.skinFlat.css');
				wp_enqueue_style( 'wp-color-picker' ); 
			}
		}
	}
}