<div class="ycf-bootstrap-wrapper">
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-title"><?php _e('Show popup title', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-popup-title" class="js-ypm-accordion" name="ypm-popup-title" <?php echo $popupTypeObj->getOptionValue('ypm-popup-title'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label"><?php _e('popup title color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-title-color" type="text" name="ypm-title-color" value="<?php echo  $popupTypeObj->getOptionValue('ypm-title-color'); ?>" /></div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-esc-key"><?php _e('Dismiss on "esc" key', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-esc-key" name="ypm-esc-key" <?php echo $popupTypeObj->getOptionValue('ypm-esc-key'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-close-button"><?php _e('Show "close" button', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-close-button" name="ypm-close-button" <?php echo $popupTypeObj->getOptionValue('ypm-close-button'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-overlay-click"><?php _e('Dismiss on overlay click', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-overlay-click" name="ypm-overlay-click" <?php echo $popupTypeObj->getOptionValue('ypm-overlay-click'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-content-click-status"><?php _e('Dismiss on content click', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-content-click-status" name="ypm-content-click-status" <?php echo $popupTypeObj->getOptionValue('ypm-content-click-status'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-disable-page-scrolling"><?php _e('Disable page scrolling', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-disable-page-scrolling" name="ypm-disable-page-scrolling" <?php echo $popupTypeObj->getOptionValue('ypm-disable-page-scrolling'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-delay"><?php _e('Popup opening delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<input type="number" id="ypm-delay" class="form-control" name="ypm-delay" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-delay')); ?>"><br>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">
		<label class="control-label" for="textinput"><?php _e('Change overlay color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-overlay-color" type="text" name="ypm-overlay-color" value="<?php echo  $popupTypeObj->getOptionValue('ypm-overlay-color'); ?>" /></div>
	</div>
</div>
<div class="row">
	<div class="col-xs-3 overlay-opacity-label">
		<label class="control-label" for="textinput"><?php _e('Background opacity', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<input type="text" id="range" name="ypm-overlay-opacity" value="<?php echo  $popupTypeObj->getOptionValue('ypm-overlay-opacity'); ?>" name="range">
	</div>
</div>


</div>