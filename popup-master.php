<?php
/**
* Plugin Name: Popup Master
* Description: Popup Master.
* Version: 2.1.2
* Author: Molly Clark
* Author URI: 
* License: GPLv2
*/
namespace YpmPopup;

require_once(dirname(__FILE__).'/config.php');
require_once(YPM_POPUP_CLASSES.'popupMasterInit.php');
define('YPM_FOLDER_NAME',  dirname( plugin_basename(__FILE__) ));

$popupMasterInstance = new popupMasterInit();

