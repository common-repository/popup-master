function YpmPopup() {

	this.ypmCount = 0;
	this.popupData = [];
	this.popupId = 0;
}

YpmPopup.prototype.setPopupData = function(popupData) {

	this.popupData = popupData;
};

YpmPopup.prototype.getPopupData = function() {

	return this.popupData;
};

YpmPopup.prototype.setPopupId = function(popupId) {

	this.popupId = popupId;
};

YpmPopup.prototype.getPopupId = function() {

	return this.popupId;
};

YpmPopup.prototype.varToBool = function (optionName) {

	var returnValue = (optionName) ? true : false;
	return returnValue;
};

YpmPopup.prototype.init = function () {

	var that = this;
	jQuery(".ypm-open-popup").each(function () {
		var popupEvent = jQuery(this).attr("data-popup-event");
		if (typeof popupEvent == 'undefined') {
			popupEvent = 'click';
		}

		that.ypmCount = 0;
		jQuery(this).bind(popupEvent, function () {

			that.ypmCount += 1;
			if (that.ypmCount > 1) {
				return;
			}
			var popupId = jQuery(this).attr("data-ypm-popup-id");
			var data = YPM_DATA[popupId];
			if(typeof data == 'undefined') {
				return false;
			}
			that.setPopupId(popupId);
			that.setPopupData(data);
			that.openPopup();
		});
	});
};

YpmPopup.prototype.customEvents = function() {
	
	var data = this.getPopupData();

	jQuery('#yrmcolorbox').on('yrmOnOpen', function() {
		
	});
};

YpmPopup.prototype.openByPopupEvent = function() {

	var popupId = this.getPopupId();
	
	if(typeof YPM_DATA[popupId] == 'undefined') {
		return;
	}
	var data = YPM_DATA[popupId];
	this.setPopupData(data);

	if(typeof data['ypm-popup-exit-enable'] != 'undefined' && data['ypm-popup-exit-enable'] == 'on') {
		YpmPopup.prototype = new YpmExit();
	}
	else {
		this.onLoad();
	}
};

YpmPopup.prototype.openPopup = function (popupId) {

	this.setPopupId(popupId);

	this.openByPopupEvent();
};

YpmPopup.prototype.onLoad = function() {

	var popupId = this.getPopupId();
	var data = this.getPopupData();
	var that = this;

	setTimeout(function () {
		that.openPopup();

	}, data['ypm-delay']*1000);
};

YpmPopup.prototype.openPopup = function () {

	this.popupEvents();
	var popupId = this.getPopupId();
	var data = this.getPopupData();

	var href = '#ypm-popup-content-wrapper-'+popupId;
	var that = this;

	var title = data['title'];
	var showTitle = this.varToBool(data['ypm-popup-title']);
	if(!showTitle) {
		title = false;
	}
	var width = data['ypm-popup-width'];
	var height = data['ypm-popup-height'];
	var maxWidth = data['ypm-popup-max-width'];
	var maxHeight = data['ypm-popup-max-height'];
	var theme = data['ypm-popup-theme'];
	var ypmOverlayOpacity = data['ypm-overlay-opacity'];
	var escKey = this.varToBool(data['ypm-esc-key']);
	var closeButton = this.varToBool(data['ypm-close-button']);
	var overlayClick = this.varToBool(data['ypm-overlay-click']);
	var content = data['content'];
	var initialWidth = 300;
	var initialHeight = 100;

	var YrmConfig = {
		popupId: popupId,
		title: title,
		html: false,
		inline: true,
		href: href,
		escKey: true,
		closeButton: true,
		overlayClose: true,
		closeButton: closeButton,
		overlayClose: overlayClick,
		opacity: ypmOverlayOpacity,
		className: 'yrm'+theme,
		escKey: escKey,
		onOpen: function() {
			jQuery("#yrmcboxOverlay").addClass("yrmcboxOverlayBg");
			if(data['ypm-overlay-color']) {
				jQuery('.yrmcboxOverlayBg').css({'background': 'none', 'background-color': data['ypm-overlay-color']})
			}
			if(data['ypm-content-click-status']) {

				jQuery('#yrmcboxContent').bind('click', function () {
					jQuery.yrmcolorbox.close();
				});
			}
			jQuery('#yrmcolorbox').trigger('yrmOnOpen', {popupId: popupId, data: data});
		},
		onCleanup: function () {
			that.ypmCount = 0;
			jQuery('#yrmcolorbox').trigger("yrmPopupCleanup", {popupId: popupId, data: data});
		},
		onComplete: function () {
			jQuery('#yrmcolorbox').trigger('yrmOnComplete', {popupId: popupId, data: data});
		},
		onClosed: function () {
			jQuery('#yrmcolorbox').trigger("yrmPopupClose", {popupId: popupId, data: data});
		}
	};

	if(width) {
		YrmConfig.width = width;
	}
	if(height) {
		YrmConfig.height = height;
	}
	if(maxWidth) {
		YrmConfig.maxWidth = maxWidth;
	}
	if(initialWidth) {
		YrmConfig.initialWidth = initialWidth;
	}
	if(initialHeight) {
		YrmConfig.initialHeight = initialHeight;
	}

	jQuery.yrmcolorbox(YrmConfig);

	this.customEvents();
};

YpmPopup.prototype.popupEvents = function () {

	jQuery('#yrmcolorbox').bind('yrmOnOpen', function (e, args) {
		console.log(args);
	});

	jQuery('#yrmcolorbox').bind("yrmPopupCleanup", function (e, args) {

	});

	jQuery('#yrmcolorbox').bind("yrmOnComplete", function (e, args) {

		var data = args.data;
		var popupId = args.popupId;
		var titleColor = data['ypm-title-color'];
		var disablePageScrolling = data['ypm-disable-page-scrolling'];

		if(disablePageScrolling) {
			jQuery('body').addClass('ypm-disable-page-scrolling');
		}
		jQuery('.ypm-popup-content-'+popupId+' #yrmcboxTitle').css({color: titleColor});
	});

	jQuery('#yrmcolorbox').bind("yrmPopupClose", function (e, args) {

		var data = args.data;
		var disablePageScrolling = data['ypm-disable-page-scrolling'];

		if(disablePageScrolling) {
			jQuery('body').removeClass('ypm-disable-page-scrolling');
		}
	});
};

YpmPopup.getCookie = function (cName) {

	var name = cName + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
};

YpmPopup.deleteCookie = function (name) {

	document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

YpmPopup.setCookie = function (cName, cValue, exDays, cPageLevel) {

	var expirationDate = new Date();
	var cookiePageLevel = '';
	var cookieExpirationData = 1;
	if (!exDays || isNaN(exDays)) {
		exDays = 365 * 50;
	}
	if (typeof cPageLevel == 'undefined') {
		cPageLevel = false;
	}
	expirationDate.setDate(expirationDate.getDate() + exDays);
	cookieExpirationData = expirationDate.toUTCString();
	var expires = 'expires='+cookieExpirationData;

	if (exDays == -1) {
		expires = '';
	}

	if (cPageLevel) {
		cookiePageLevel = 'path=/;';
	}

	var value = cValue + ((exDays == null) ? ";" : "; " + expires + ";" + cookiePageLevel);
	document.cookie = cName + "=" + value;
};

jQuery(document).ready(function ($) {

	var ypmObj = new YpmPopup();
	ypmObj.init();
});