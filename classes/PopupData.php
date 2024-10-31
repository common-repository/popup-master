<?php
class YpmPopupData {

	public static function popupDefaultData() {

		$dataArray = array();
		$dataArray['ypm-popup-width'] = '';
		$dataArray['ypm-popup-height'] = '';

 		return apply_filters('YpmDefaultDataValues', $dataArray);
	}

	public static function popupOptionsKeys() {

		$popupOptions = self::popupDefaultData();
		if(empty($popupOptions)) {
			return array();
		}
		$popupOptionsName = array_keys($popupOptions);

		return $popupOptionsName;
	}

	public static function defaultsData() {

		$defaults = array();

		$defaults['themes'] = array(
			'colorbox1',
			'colorbox2',
			'colorbox3',
			'colorbox4',
			'colorbox5'
		);

		$defaults['fbButtons'] = array(
			'likeButton' => __('Like Button', YPM_POPUP_TEXT_DOMAIN),
			'shareButton' => __('Share Button', YPM_POPUP_TEXT_DOMAIN)
		);

		return $defaults;
	}
}