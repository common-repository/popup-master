<?php
namespace YpmPopup;
class ScriptsManager {

	public static function registerStyle($styleName, $args = array()) {

		$src = YPM_POPUP_CSS_URL;
		$deps = array();
		$ver = YPM_POPUP_VERSION;
		$media = 'all';

		if(!empty($args['styleSrc'])) {
			$src = $args['styleSrc'];
		}

		if(!empty($args['deps'])) {
			$deps = $args['deps'];
		}

		if(!empty($args['version'])) {
			$ver = $args['version'];
		}

		if(!empty($args['media'])) {
			$media = $args['media'];
		}

		$src = $src.'/'.$styleName;

		wp_register_style($styleName, $src, $deps, $ver, $media);
	}

	public static function enqueueStyle($style) {

		wp_enqueue_style($style);
	}
}