<?php
$defaults = YpmPopupData::defaultsData();
$themData = $defaults['themes'];
?>
<div class="ycf-bootstrap-wrapper">
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="textinput"><?php _e('Popup theme', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<?php echo YpmFunctions::createRadioButtons($themData, $popupTypeObj->getOptionValue('ypm-popup-theme'), array('name' => 'ypm-popup-theme'))?>
		</div>
	</div>
</div>