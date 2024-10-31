<div class="ycf-bootstrap-wrapper">
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-width"><?php _e('Width', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" id="ypm-popup-width" class="form-control" name="ypm-popup-width" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-width')); ?>"><br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-height"><?php _e('Height', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" id="ypm-popup-height" class="form-control" name="ypm-popup-height" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-height')); ?>"><br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-max-width"><?php _e('Max width', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" id="ypm-popup-max-width" class="form-control" name="ypm-popup-max-width" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-max-width')); ?>"><br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-max-height"><?php _e('Max Height', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" id="ypm-popup-max-height" name="ypm-popup-max-height" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-max-height')); ?>"><br>
		</div>
	</div>
</div>