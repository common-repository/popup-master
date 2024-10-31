<?php
global $YpmDefaultsData;
$devices = $YpmDefaultsData['devices'];
$countries = $YpmDefaultsData['countries'];
?>
<div class="ycf-bootstrap-wrapper ycf-pro-wrapper" xmlns="http://www.w3.org/1999/html">
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-3">
			<label for="ypm-show-on-device-status"><?php _e('Shwo on selected devices', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-4">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-show-on-device-status" name="ypm-show-on-device-status" class="js-ypm-accordion" <?php echo $popupTypeObj->getOptionValue('ypm-show-on-device-status')?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<?php _e('Select device(s)', YPM_POPUP_TEXT_DOMAIN)?>
		</div>
		<div class="col-md-4">
			<?php echo YpmFunctions::createSelectBox($devices, $popupTypeObj->getOptionValue('ypm-devices'), array('name' => 'ypm-devices[]', 'multiple' => 'multiple')); ?>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-3">
			<label for="ypm-selected-countries-status"><?php _e('Popup for selected countries', YPM_POPUP_TEXT_DOMAIN); ?></label>
		</div>
		<div class="col-md-4">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-selected-countries-status" name="ypm-selected-countries-status" class="js-ypm-accordion" <?php echo $popupTypeObj->getOptionValue('ypm-selected-countries-status')?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<?php _e('selected countries', YPM_POPUP_TEXT_DOMAIN)?>
		</div>
		<div class="col-md-4">
			<?php echo YpmFunctions::createSelectBox($countries, $popupTypeObj->getOptionValue('ypm-selected-countries'), array('name' => 'ypm-selected-countries[]', 'multiple' => 'multiple', 'class'=>'js-basic-select form-control')); ?>
		</div>
	</div>
	<?php if(YPM_POPUP_PKG == YPM_POPUP_FREE): ?>
		<div class="yrm-pro-options">
			<p class="yrm-pro-options-title">PRO Features</p>
		</div>
	<?php endif;?>
</div>