<?php
namespace YpmPopup;
use \YpmConfig;
use \YpmFunctions;

class Actions {

	private $postTypeObj;

	public function setPostTypeObj($postTypeObj) {

		$this->postTypeObj = $postTypeObj;
	}

	public function getPostTypeObj() {

		return $this->postTypeObj;
	}

	public function __construct() {

		$this->init();
	}

	public function init() {

		add_action('init', array($this, 'postTypeInit'));
		add_action('add_meta_boxes', array($this, 'addMetaBoxes'));

		add_action('save_post', 'YpmSavePopup::savePopupData', 10, 3);
		add_action('admin_enqueue_scripts', 'YpmPopup\Style::enqueueStyles');
		add_action('wp_head', array($this, 'ypmHeadAction'));

		add_shortcode('ypm_popup', array($this, 'ypmShortCode'));
		add_action('media_buttons', array($this, 'ypmPopupMediaButton'), 11);
		add_action('media_buttons', array($this, 'ypmPopupMediaModules'), 11);
		add_action('admin_footer', array($this, 'ypmPopupMediaButtonThickboxs'));
		add_action('admin_footer', array($this, 'ypmPopupModulesTickboxs'));
		add_action('add_meta_boxes', array($this, 'pageSelection'));
		add_action('plugins_loaded', array($this, 'ypmPluginLoaded'));

		/// Filters
		add_filter('ypmIframeModuleLabels', array($this, 'iframeLabels'), 1, 1);
		$this->filterPopupModulesTableColumn();
	}

	public function iframeLabels($labels) {
		if(YPM_POPUP_PKG == YPM_POPUP_FREE) {
			$labels['all_items'] = $labels['all_items'] . '<span style="color: red"> (Pro)</span>';
			$labels['add_new_item'] = $labels['add_new_item'] . '<span style="color: red"> (Pro)</span>';
			$labels['name'] = $labels['name'] . ' (Pro) ';
		}
		return $labels;
	}

	public function ypmPopupMediaButton() {

		YpmMediaButton::addMediaButton();
	}

	public function ypmPopupMediaModules() {

		YpmMediaButton::addMediaModuleButton();
	}

	public function ypmPopupMediaButtonThickboxs() {

		YpmMediaButton::ypmThickbox();
	}

	public function ypmPopupModulesTickboxs() {

		YpmMediaButton::ypmModulesThickbox();
	}

	public function ypmShortCode($args, $content) {

		$obj = new YpmShortcode();
		$obj->setAttrs($args);
		$obj->setContent($content);
		return $obj->render();
	}

	public function postTypeInit() {

		$postType = new \YpmRegistration();
		$this->setPostTypeObj($postType);
	}

	public function addMetaBoxes() {

		$this->getPostTypeObj()->addMetaBoxes();
		$this->getPostTypeObj()->general();
		$this->getPostTypeObj()->settings();
		$this->getPostTypeObj()->exitIntent();
		$this->getPostTypeObj()->conditions();
		$this->getPostTypeObj()->facebookOptions();
		$this->getPostTypeObj()->iframeSettings();

		if(YPM_POPUP_PKG == YPM_POPUP_FREE) {
			$this->getPostTypeObj()->upgradeToProMetabox();
		}
	}

	public function ypmHeadAction() {

		new Header();
	}

	public function pageSelection() {

		$screens = array('post', 'page');
		foreach ($screens as $screen) {
			add_meta_box('ypmSelectedPopup', __('Select popup maker on page load', YPM_POPUP_TEXT_DOMAIN), array($this, 'pageSelectionMetaBox'), $screen, 'side');
		}
	}

	public function pageSelectionMetaBox() {

		$popupData = Popup::getPopupIdTitleData();
		$metaboxData = array('' => 'Not Selected')+ $popupData;
		$postId = '';

		if(!empty($_GET['post'])) {
			$postId = $_GET['post'];
		}
		$popupSelectedId = get_post_meta($postId, 'ypm-metabox-popup');
		echo YpmFunctions::createSelectBox($metaboxData, $popupSelectedId, array('id' => 'ypm-metabox-popup-id', 'name' => 'ypm-metabox-popup'));
	}

	public function ypmPluginLoaded() {

		load_plugin_textdomain(YPM_POPUP_TEXT_DOMAIN, false, YPM_FOLDER_NAME.'/lang/');
	}

	public function filterPopupModulesTableColumn() {

		global $PostTypesInfo;
		$popupPostTypes = $PostTypesInfo['postTypes'];
		unset($popupPostTypes[YPM_POPUP_POST_TYPE]);

		if(empty($popupPostTypes)) {
			return false;
		}

		foreach ($popupPostTypes as $postType => $postTypeLevel) {
			add_filter('manage_'.$postType.'_posts_columns' , array($this, 'popupStickyColumn'));
			add_action('manage_'.$postType.'_posts_custom_column' , array($this, 'postTypeColumn'), 10, 2);
		}
	}

	public function postTypeColumn($column, $postId) {

		if ($column == 'shortcode') {
			$postType = get_post_type($postId);
			$shortCodeStr = str_replace('ypm', 'ypm_', $postType);
			echo '<input onfocus="this.select();" readonly="" value="['.$shortCodeStr.' id='.$postId.']" class="large-text code" type="text">';
		}
	}

	public function popupStickyColumn($columns) {

		unset($columns['author']);
		unset($columns['date']);
		return array_merge(
			$columns, array('shortcode' => __('shortcode'))
		);
	}
}