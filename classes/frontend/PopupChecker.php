<?php
namespace ypmFrontend;

Class PopupChecker {

	private $popupObj;

	public function __construct($popupObj) {
		$this->setPopupObj($popupObj);
	}

	public function setPopupObj($popupObj) {
		$this->popupObj = $popupObj;
	}

	public function getPopupObj() {
		return $this->popupObj;
	}

	public function isAllow() {

		$status = true;

		if(!$this->checkConditions()) {
			return false;
		}

		return $status;
	}

	private function checkConditions() {

		$status = true;
		$options = $this->getPopupObj()->getOptions();

		if(!empty($options['ypm-show-on-device-status'])) {
			require_once 'Mobile_Detect.php';
			$detect = new \Mobile_Detect;
			$devices = $options['ypm-devices'];
			if(!empty($devices)) {
				foreach($devices as $device) {
					$match = true;
					if($device == 'desktop') {
						$match = !$detect->isMobile();
					}
					if($device == 'tablet') {
						$match = $detect->isTablet();
					}
					if($device == 'isiOS') {
						$match = $detect->isiOS();
					}
					if($device == 'isAndroid') {
						$match = (!$detect->isiOS() && $detect->isAndroidOS() );
					}
					if(!$match) {
						return false;
					}
				}

				return $match;
			}

			return $status;
		}
		if(!empty($options['ypm-selected-countries-status'])) {
			$match = false;
			require_once(YPM_POPUP_LIBS."/SxGeo/SxGeo.php");
			$ip = ProHelper::getIpAddress();

			$SxGeo = new SxGeo(YPM_POPUP_LIBS."/SxGeo/SxGeo.dat");
			$country = $SxGeo->getCountry($ip);
			$selectedCountries = $options['ypm-selected-countries'];

			if(!empty($selectedCountries)) {
				if(in_array($country, $selectedCountries)) {
					$match = true;
				}
			}

			return $match;
		}

		return $status;
	}
}