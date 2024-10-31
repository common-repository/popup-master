<?php
class YpmConfig {

	public function __construct() {
		if (!defined( 'ABSPATH' )) {
			exit();
		}

		$this->addDefines();
		$this->addFilters();
		$this->defaultValues();
	}

	private function addFilters() {
		if(YPM_POPUP_PKG != YPM_POPUP_FREE) {
			require_once(YPM_POPUP_CLASSES.'YpmFiltersPro.php');
		}
	}

	public function addDefines() {

		define('YPM_POPUP_PATH', dirname(__FILE__));
		define('YPM_POPUP_URL', plugins_url('', __FILE__).'/');
		define('YPM_POPUP_ADMIN_URL', admin_url());
		define('YPM_POPUP_FILE', plugin_basename(dirname(__FILE__).'/'));
		define('YPM_POPUP_FILES', YPM_POPUP_PATH . '/files/');
		define('YPM_POPUP_CLASSES', YPM_POPUP_PATH . '/classes/');
		define('YPM_POPUP_CLASSES_FRONTEND', YPM_POPUP_CLASSES . '/frontend/');
		define('YPM_POPUP_HELPERS', YPM_POPUP_PATH . '/helpers/');
		define('YPM_POPUP_LIBS', YPM_POPUP_PATH . '/libs/');
		define('YPM_POPUP_TEXT_DOMAIN', 'popup_master');
		define('YPM_POPUP_POST_TYPE', 'popupmaster');
		define('YPM_FACEBOOK_POST_TYPE', 'ypmfacebook');
		define('YPM_IFRAME_POST_TYPE', 'ypmiframe');
		define('YPM_POPUP_FREE', 1);
		define('YPM_POPUP_SILVER', 2);
		define('YPM_POPUP_GOLD', 3);
		require_once(YPM_POPUP_PATH.'/config-pkg.php');
		define('YPM_POPUP_VERSION', 2.12);
		define('YPM_POPUP_PRO_URL', 'http://edmion.esy.es/popup-maker/');

		/*Assets defines*/
		define('YPM_POPUP_ASSETS', YPM_POPUP_PATH . '/assets/');
		define('YPM_POPUP_VIEW', YPM_POPUP_ASSETS . 'view/');
		define('YPM_POPUP_CSS', YPM_POPUP_ASSETS . 'css/');
		define('YPM_POPUP_CSS_URL', YPM_POPUP_URL . 'assets/css/');
		define('YPM_POPUP_JS_URL', YPM_POPUP_URL . 'assets/javascript/');
		define('YPM_POPUP_JS', YPM_POPUP_ASSETS . 'javascript/');
		define('YPM_POPUP_IMG', YPM_POPUP_ASSETS . 'img/');
	}

	public function defaultValues() {
		global $YpmDefaults;
		global $YpmDefaultsData;
		global $PostTypesInfo;

		$options = array();

		$exitMode = array(
			'soft' => __('Soft mode', YPM_POPUP_TEXT_DOMAIN),
			'agressive' => __('Aggressive mode', YPM_POPUP_TEXT_DOMAIN),
			'softAgres' => __('Soft and Aggressive modes', YPM_POPUP_TEXT_DOMAIN),
			'alert' => __('Aggressive without popup', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeLayout = array(
			'standard' => __('Standard', YPM_POPUP_TEXT_DOMAIN),
			'button_count' => __('Button with count', YPM_POPUP_TEXT_DOMAIN),
			'box_count' => __('Box with count', YPM_POPUP_TEXT_DOMAIN),
			'button' => __('Button', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeShareLayout = array(
			'box_count' => __('Box with count', YPM_POPUP_TEXT_DOMAIN),
			'button_count' => __('Button with count', YPM_POPUP_TEXT_DOMAIN),
			'button' => __('Button', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeAction = array(
			'like' => __('Like', YPM_POPUP_TEXT_DOMAIN),
			'recommend' => __('Recommend', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeSize = array(
			'small' => __('Small', YPM_POPUP_TEXT_DOMAIN),
			'large' => __('Large', YPM_POPUP_TEXT_DOMAIN)
		);

		$fbLikeAlignment = array(
			'left' => __('Left', YPM_POPUP_TEXT_DOMAIN),
			'center' => __('Center', YPM_POPUP_TEXT_DOMAIN),
			'right' => __('Right', YPM_POPUP_TEXT_DOMAIN)
		);

		$devices = array(
			'desktop' => __('Desktop', YPM_POPUP_TEXT_DOMAIN),
			'tablet' => __('Tablet', YPM_POPUP_TEXT_DOMAIN),
			'isiOS' => __('Ios', YPM_POPUP_TEXT_DOMAIN),
			'isAndroid' => __('Android', YPM_POPUP_TEXT_DOMAIN)
		);

		$countries = array(
		);

		$postTypes = apply_filters('ypm-post-types', array(
			YPM_POPUP_POST_TYPE,
			YPM_FACEBOOK_POST_TYPE
		));
		$options[] = array('name' => 'ypm-popup-width', 'type' => 'string', 'defaultValue' => '640px');
		$options[] = array('name' => 'ypm-popup-height', 'type' => 'string', 'defaultValue' => '480px');
		$options[] = array('name' => 'ypm-popup-max-width', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-max-height', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-theme', 'type' => 'string', 'defaultValue' => 'colorbox1');
		$options[] = array('name' => 'ypm-esc-key', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-close-button', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-overlay-click', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-overlay-color', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-title', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-delay', 'type' => 'string', 'defaultValue' => 0);
		$options[] = array('name' => 'ypm-popup-exit-mode', 'type' => 'string', 'defaultValue' => 'soft');
		$options[] = array('name' => 'ypm-exit-alert-text', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-exit-per-day', 'type' => 'string', 'defaultValue' => '1');
		$options[] = array('name' => 'ypm-exit-page-lavel', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-exit-leave-top', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-exit-enable', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-overlay-opacity', 'type' => 'text', 'defaultValue' => 0.8);
		$options[] = array('name' => 'ypm-facebook-type', 'type' => 'text', 'defaultValue' => 'likeButton');
		$options[] = array('name' => 'ypm-facebook-layout', 'type' => 'text', 'defaultValue' => 'likeButton');
		$options[] = array('name' => 'ypm-facebook-action', 'type' => 'text', 'defaultValue' => 'like');
		$options[] = array('name' => 'ypm-facebook-size', 'type' => 'text', 'defaultValue' => 'small');
		$options[] = array('name' => 'ypm-facebook-url', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-button', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-facebook-like-alignment', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-facebook-type', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-facebook-share-url', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-layout', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-size', 'type' => 'text', 'defaultValue' => 'small');
		$options[] = array('name' => 'ypm-facebook-share-alignment', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-show-on-device-status', 'type' => 'checkbox', 'defaultValue' => 'likeButton');
		$options[] = array('name' => 'ypm-devices', 'type' => 'array', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-selected-countries-status', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-selected-countries', 'type' => 'array', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-status', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-title-color', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-disable-page-scrolling', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-iframe-url', 'type' => 'text', 'defaultValue' => 'https://www.wikipedia.org/');
		$options[] = array('name' => 'ypm-iframe-width', 'type' => 'text', 'defaultValue' => '300px');
		$options[] = array('name' => 'ypm-iframe-height', 'type' => 'text', 'defaultValue' => '200px');
		$YpmDefaults = $options;

		$YpmDefaultsData['exitMode'] = $exitMode;
		$YpmDefaultsData['fblikeLayout'] = $fblikeLayout;
		$YpmDefaultsData['fblikeAction'] = $fblikeAction;
		$YpmDefaultsData['fblikeSize'] = $fblikeSize;
		$YpmDefaultsData['postTypes'] = $postTypes;
		$YpmDefaultsData['fbLikeAlignment'] = $fbLikeAlignment;
		$YpmDefaultsData['fblikeShareLayout'] = $fblikeShareLayout;
		$YpmDefaultsData['devices'] = $devices;
		$YpmDefaultsData['countries'] = apply_filters('ypm-countries', $countries);

		$PostTypesInfo['postTypes'] = array(
			YPM_POPUP_POST_TYPE => YPM_POPUP_FREE,
			YPM_FACEBOOK_POST_TYPE => YPM_POPUP_FREE,
			YPM_IFRAME_POST_TYPE => YPM_POPUP_SILVER,
		);

		$PostTypesInfo['levelLabels'] = array(
			YPM_POPUP_FREE => __('Free', YPM_POPUP_TEXT_DOMAIN),
			YPM_POPUP_SILVER => __('Silver', YPM_POPUP_TEXT_DOMAIN)
		);
	}

	public static function YpmHeaders() {

		$headers = "<script type='text/javascript'>
					function yrmAddEvent(element, eventName, fn) {
		                if (element.addEventListener)
		                    element.addEventListener(eventName, fn, false);
		                else if (element.attachEvent)
		                    element.attachEvent('on' + eventName, fn);
	                }
	                YPM_IDS = [];
	                YPM_DATA = [];
	               
	                </script>";

		return $headers;
	}
}

$configObj = new YpmConfig();
