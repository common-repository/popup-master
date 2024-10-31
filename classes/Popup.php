<?php
namespace YpmPopup;
use \WP_Query;

abstract class Popup {

	private $sanitizedData;
	private $popupId;

	public function setPopupId($popupId) {

		$this->popupId = $popupId;
	}

	public function getPopupId() {

		return $this->popupId;
	}

	public function insertIntoSanitizedData($sanitizedData) {

		if(!empty($sanitizedData)) {
			$this->sanitizedData[$sanitizedData['name']] = $sanitizedData['value'];
		}
	}

	public function setSanitizedData($sanitizedData) {

		$this->sanitizedData = $sanitizedData;
	}

	public function getSanitizedData() {

		return $this->sanitizedData;
	}

	public function sanitizeValueByType($value, $type) {

		$sanitizedValue = '';
		switch ($type) {
			case 'string':
				$sanitizedValue = sanitize_text_field($value);
				break;
			case 'array':
				$sanitizedValue = $this->recursiveSanitizeTextField($value);
				break;
			case 'email':
				$sanitizedValue = sanitize_email($value);
				break;
			default:
				$sanitizedValue = sanitize_text_field($value);
				break;
		}

		return $sanitizedValue;
	}

	public function recursiveSanitizeTextField($array) {

		foreach ($array as $key => &$value) {
			if (is_array($value)) {
				$value = $this->recursiveSanitizeTextField($value);
			}
			else {
				$value = sanitize_text_field($value);
			}
		}

		return $array;
	}

	public static function create($data, $obj) {

		foreach($data as $name => $value) {

			if(strpos($name, 'ypm') === 0) {
				$defaultData = $obj->getDefaultDataByName($name);
				if(empty($defaultData['type'])) {
					$defaultData['type'] = 'string';
				}

				$sanitizedValue = $obj->sanitizeValueByType($value, $defaultData['type']);
				$obj->insertIntoSanitizedData(array('name' => $name,'value' => $sanitizedValue));
			}

		}
		$obj->save();
	}

	public function save() {

		$data = $this->getSanitizedData();

		update_post_meta($data['ypm-popup-id'], "ypm-data", $data);
	}

	public function getOptionValue($optionName) {

		$savedData = Popup::getSavedData($this->getPopupId());
		$defaultData = $this->getDefaultDataByName($optionName);
		$optionValue = '';
		
		if(!empty($savedData[$optionName])) {
			$optionValue = $savedData[$optionName];
		}
		else if($defaultData['defaultValue'] == 0 || !empty($defaultData['defaultValue'])) {
			$optionValue = $defaultData['defaultValue'];
		}

		if(!empty($defaultData['type']) && $defaultData['type'] == 'checkbox') {
			if(!empty($savedData) && empty($savedData[$optionName])) {
				$optionValue = $this->boolToChecked('');
			}
			else {
				$optionValue = $this->boolToChecked($optionValue);
			}
		}

		return $optionValue;
	}

	public static function getSavedData($popupId) {

		return get_post_meta($popupId, 'ypm-data', true);
	}

	private function getDefaultDataByName($optionName) {

		global $YpmDefaults;

		foreach($YpmDefaults as $option) {
			if($option['name'] == $optionName) {
				return $option;
			}
		}

		return array();
	}

	public static function getPopupIdTitleData() {

		$popupMasterData  = get_post_type_object(YPM_POPUP_POST_TYPE);
		$args = array(
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_status'      => 'publish',
			'post_type'        =>  YPM_POPUP_POST_TYPE,
		);
		$popupMasterData  = get_posts($args);
		$data = array();

		foreach($popupMasterData as $postData) {

			$data[$postData->ID] = $postData->post_title;
		}

		return $data;
	}

	public function getSiteLocale() {

		$locale = get_bloginfo('language');
		$locale = str_replace('-', '_', $locale);

		return $locale;
	}

	public function boolToChecked($var) {
		return ($var?'checked':'');
	}

	public static function getModulesDataArray() {

		global $PostTypesInfo;
		$modulesDataArray = array();
		$postTypes = $PostTypesInfo['postTypes'];

		if(empty($postTypes)) {
			return $modulesDataArray;
		}
		unset($postTypes[YPM_POPUP_POST_TYPE]);
		foreach($postTypes as $postType => $postTypeLevel) {
			$moduleName = str_replace('ypm', '', $postType);
			$moduleName = ucfirst(strtolower($moduleName));

			$query = new WP_Query(
				array(
					'post_type'      => $postType,
					'posts_per_page' => - 1
				)
			);

			$currentModule = array();
			if($query->have_posts()) {
				/*We check all the popups one by one to realize whether they might be loaded or not.*/
				while($query->have_posts()) {
					$query->next_post();
					$id = $query->post->ID;

					$currentModule[$id] = $query->post->post_title;
				}
				$modulesDataArray[$moduleName] = $currentModule;
			}
			else {
				$modulesDataArray[$moduleName] = array('' => __('No data', YPM_POPUP_TEXT_DOMAIN));
			}
		}
		return $modulesDataArray;
	}

	public static function isPostPublished($postId) {

		$status = true;
		$postSTatus = get_post_status($postId);
		if(empty($postSTatus) || get_post_status($postId) != 'publish') {
			$status = false;
		}

		return $status;
	}
}