<?php
global $YpmDefaultsData;
$defaults = YpmPopupData::defaultsData();
$fbButtons = $defaults['fbButtons'];
$facebookLayout = $YpmDefaultsData['fblikeLayout'];
$fblikeAction = $YpmDefaultsData['fblikeAction'];
$fblikeSize = $YpmDefaultsData['fblikeSize'];
$fbLikeAlignment = $YpmDefaultsData['fbLikeAlignment'];
$savedData = $popupTypeObj->getOptionValue('ypm-facebook-type');
$options = array(
	'popupTypeObj' => $popupTypeObj,
	'viewPath' => YPM_POPUP_VIEW.'facebook-types/'
);
?>
<div class="ycf-bootstrap-wrapper">
	<?php echo new TabBuilder($fbButtons, $savedData, $options);?>
	<input type="hidden" name="ypm-facebook-type" class="ypm-facebook-type" value="<?php echo esc_attr($savedData); ?>">
</div>