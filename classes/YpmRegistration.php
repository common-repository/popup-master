<?php
class YpmRegistration {

	private $popupTypeObj;

	public function __construct() {

		$this->createPostType();
		$this->registerCustomPostType();
	}

	public function createPostType() {

		global $PostTypesInfo;
		$popupId = 0;
		$popupPostType = 'ypmHtml';

		if(!empty($_GET['post'])) {
			$popupId = $_GET['post'];
		}

		if(!empty($_GET['post_type']) && $_GET['post_type'] != YPM_POPUP_POST_TYPE) {
			$popupPostType = $_GET['post_type'];
		}

		if(!empty($_GET['post'])) {
			$popupPostType = get_post_type($_GET['post']);
		}
		$popupPostTypes = $PostTypesInfo['postTypes'];
		if($popupPostType == YPM_POPUP_POST_TYPE || empty($popupPostTypes[$popupPostType])) {
			$popupPostType = 'ypmHtml';
		}

		$ypmPostType = str_replace('ypm','',$popupPostType);
		$ypmPostType = ucfirst(strtolower($ypmPostType));
		$popupClassName = $ypmPostType.'Popup';
		require_once(YPM_POPUP_CLASSES .$popupClassName.'.php');
		$className = 'YpmPopup\\'.$popupClassName;
		$popupTypeObj = new $className;
		$popupTypeObj->setPopupId($popupId);
		$this->setPopupTypeObj($popupTypeObj);
	}

	public function setPopupTypeObj($popupTypeObj) {

		$this->popupTypeObj = $popupTypeObj;
	}

	public function getPopupTypeObj() {

		return $this->popupTypeObj;
	}

	private function createModuleLabels($moduleKey) {

		$labels = array(
			'name'          => $moduleKey.' module',
			'singular_name' => $moduleKey,
			'all_items'          => _x($moduleKey.' module', 'Post Type Menu Label', YPM_POPUP_TEXT_DOMAIN),
			'add_new_item'       => _x("Add New $moduleKey", 'Post Type Singular: "Popup"', YPM_POPUP_TEXT_DOMAIN),
			'edit_item'          => _x("Edit $moduleKey", 'Post Type Singular: "Popup"', YPM_POPUP_TEXT_DOMAIN),
			'new_item'           => _x("New $moduleKey", 'Post Type Singular: "Popup"', YPM_POPUP_TEXT_DOMAIN),
			'view_item'          => _x("View $moduleKey", 'Post Type Singular: "Popup"', YPM_POPUP_TEXT_DOMAIN),
			'search_items'       => _x("Search $moduleKey", 'Post Type Plural: "Popups"', YPM_POPUP_TEXT_DOMAIN),
			'not_found'          => _x("No $moduleKey found", 'Post Type Plural: "Popups"', YPM_POPUP_TEXT_DOMAIN),
			'not_found_in_trash' => _x("No $moduleKey found in Trash", 'Post Type Plural: "Popups"', YPM_POPUP_TEXT_DOMAIN),
			'add_new'            => _x("Add $moduleKey", 'Post Type Singular: "Popup"', YPM_POPUP_TEXT_DOMAIN),

		);

		return $labels;
	}

	public function registerCustomPostType() {

		$labels = array(
			'name'               => _x( 'Popup Maker', 'post type general name', YPM_POPUP_TEXT_DOMAIN),
			'singular_name'      => _x( 'Popup Maker', 'post type singular name', YPM_POPUP_TEXT_DOMAIN),
			'menu_name'          => _x( 'Popup Maker', 'admin menu', YPM_POPUP_TEXT_DOMAIN),
			'name_admin_bar'     => _x( 'Popup Maker', 'add new on admin bar', YPM_POPUP_TEXT_DOMAIN),
			'add_new'            => _x( 'Add New', 'popup', YPM_POPUP_TEXT_DOMAIN),
			'add_new_item'       => __( 'Add New Popup', YPM_POPUP_TEXT_DOMAIN),
			'new_item'           => __( 'New Popup', YPM_POPUP_TEXT_DOMAIN),
			'edit_item'          => __( 'Edit Popup', YPM_POPUP_TEXT_DOMAIN),
			'view_item'          => __( 'View Popup', YPM_POPUP_TEXT_DOMAIN),
			'all_items'          => __( 'All Popups', YPM_POPUP_TEXT_DOMAIN),
			'search_items'       => __( 'Search Popups', YPM_POPUP_TEXT_DOMAIN),
			'parent_item_colon'  => __( 'Parent Popups:', YPM_POPUP_TEXT_DOMAIN),
			'not_found'          => __( 'No popups found.', YPM_POPUP_TEXT_DOMAIN),
			'not_found_in_trash' => __( 'No popups found in Trash.', YPM_POPUP_TEXT_DOMAIN)
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', YPM_POPUP_TEXT_DOMAIN),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'popup'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array()
		);

		register_post_type(YPM_POPUP_POST_TYPE, $args);

		$facebookTypeLabels = apply_filters('ypmFacebookModule', $this->createModuleLabels('Facebook'));

		$facebookTypeArgs      = array(
			'labels'            => $facebookTypeLabels,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_in_menu'      => 'edit.php?post_type='.YPM_POPUP_POST_TYPE,
			'show_in_admin_bar' => false,
			'query_var'         => false,
			'supports'          => apply_filters('ypmFacebookSupport', array('title')),
		);
		register_post_type(YPM_FACEBOOK_POST_TYPE, apply_filters('ypmFacebooktypeArgs', $facebookTypeArgs));

		$iframeTypeLabels = apply_filters('ypmIframeModuleLabels', $this->createModuleLabels('Iframe'));

		$iframeTypeArgs      = array(
			'labels'            => $iframeTypeLabels,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_in_menu'      => 'edit.php?post_type='.YPM_POPUP_POST_TYPE,
			'show_in_admin_bar' => false,
			'query_var'         => false,
			'supports'          => apply_filters('ypmFacebookSupport', array('title')),
		);
		register_post_type(YPM_IFRAME_POST_TYPE, apply_filters('ypmFacebooktypeArgs', $iframeTypeArgs));

		add_filter('manage_'.YPM_POPUP_POST_TYPE.'_posts_columns' , array($this, 'popupsStickyColumn'));
		add_action('manage_'.YPM_POPUP_POST_TYPE.'_posts_custom_column' , array($this, 'popupTableColumnValues'), 10, 2);
	}

	public function popupTableColumnValues($column, $postId) {

		if ($column == 'shortcode'){
			echo '<input onfocus="this.select();" readonly="" value="[ypm_popup id='.$postId.']" class="large-text code" type="text">';
		}
	}

	public function popupsStickyColumn($columns) {

		unset($columns['author']);
		unset($columns['date']);
		return array_merge( $columns,
			array('shortcode' => __('shortcode')) );
	}

	public function addMetaBoxes() {

		YpmPopup\Popup::getPopupIdTitleData();
		add_meta_box('popup_master_dimension', __('Popup dimensions', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupDimensionsOptions'), YPM_POPUP_POST_TYPE, 'advanced');
	}

	public function general() {

		add_meta_box('popup_master_options', __('General', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupGeneralOptions'), YPM_POPUP_POST_TYPE, 'advanced');
	}

	public function settings() {

		add_meta_box('popup_master_settings', __('Settings', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupGeneralSettings'), YPM_POPUP_POST_TYPE, 'advanced');
	}

	public function exitIntent() {

		add_meta_box('popup_master_exit', __('Exit intent', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupExitIntent'), YPM_POPUP_POST_TYPE, 'advanced');
	}

	public function conditions() {

		add_meta_box('popup_master_conditions', __('Conditions', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupConditions'), YPM_POPUP_POST_TYPE, 'advanced');
	}

	public function upgradeToProMetabox() {

		add_meta_box('popup_master_upgrade', __('Upgrade', YPM_POPUP_TEXT_DOMAIN), array($this, 'upgradeToPro'), array(YPM_FACEBOOK_POST_TYPE, YPM_POPUP_POST_TYPE), 'side');
	}

	public function facebookOptions() {

		add_meta_box('facebook_options', __('Facebook options', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupFacebookOptions'), YPM_FACEBOOK_POST_TYPE, 'advanced');
	}

	public function iframeSettings() {

		add_meta_box('ifranme_options', __('Iframe options', YPM_POPUP_TEXT_DOMAIN), array($this, 'popupIframeOptions'), YPM_IFRAME_POST_TYPE, 'advanced');
	}

	public function popupDimensionsOptions($params) {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'dimensions.php')) {
			require_once(YPM_POPUP_VIEW.'dimensions.php');
		}
	}

	public function popupGeneralOptions() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'general.php')) {
			require_once(YPM_POPUP_VIEW.'general.php');
		}
	}

	public function popupExitIntent() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'exit.php')) {
			require_once(YPM_POPUP_VIEW.'exit.php');
		}
	}

	public function popupConditions() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'conditions.php')) {
			require_once(YPM_POPUP_VIEW.'conditions.php');
		}
	}

	public function upgradeToPro() {

		if(file_exists(YPM_POPUP_VIEW.'upgrade.php')) {
			require_once(YPM_POPUP_VIEW.'upgrade.php');
		}
	}

	public function popupGeneralSettings() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'settings.php')) {
			require_once(YPM_POPUP_VIEW.'settings.php');
		}
	}

	public function popupFacebookOptions() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'facebookOptions.php')) {
			require_once(YPM_POPUP_VIEW.'facebookOptions.php');
		}
	}

	public function popupIframeOptions() {

		$popupTypeObj = $this->getPopupTypeObj();
		if(file_exists(YPM_POPUP_VIEW.'iframe.php')) {
			require_once(YPM_POPUP_VIEW.'iframe.php');
		}
	}
}