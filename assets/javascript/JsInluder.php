<?php
class JsInluder {

	public function __construct() {
		
		add_action('admin_enqueue_scripts', array($this, 'ypmEnqueueScripts'));
	}

	public function ypmEnqueueScripts($hook) {

		global $post, $PostTypesInfo;
		if ($hook == 'post-new.php' || $hook == 'post.php') {

			$popupPostTypes = $PostTypesInfo['postTypes'];

			if (!empty($popupPostTypes[$post->post_type])) {
				wp_register_script('ionRangeSlider', YPM_POPUP_JS_URL . '/ionRangeSlider.js', array('jquery', 'wp-color-picker'));
				wp_enqueue_script('ionRangeSlider');
				wp_register_script('select2', YPM_POPUP_JS_URL . '/select2.js');
				wp_enqueue_script('select2');
			 	wp_register_script('ypmAdminJs', YPM_POPUP_JS_URL . '/ypmAdminJs.js', array('jquery', 'wp-color-picker'));
				wp_localize_script('ypmAdminJs', 'YpmAdminParams', array('ajaxNonce' => wp_create_nonce('ypmPbNonce')));
			 	wp_enqueue_script('ypmAdminJs');
				wp_register_script('bootstrapmin', YPM_POPUP_JS_URL . '/bootstrap.min.js');
				wp_enqueue_script('bootstrapmin');
			} 
		}
	}
}

new JsInluder();