function YpmObserver() {

	this.list = [];
	this.currentId = 0;
}

YpmObserver.prototype.init = function () {

	if(!YPM_IDS.length) {
		return;
	}

	this.list = YPM_IDS;
	this.currentId = this.list[0];

	this.openCurrent();
	this.nextListener();
	console.log(YPM_IDS);
};

YpmObserver.prototype.openCurrent = function () {

	this.openPopup(this.currentId);
};

YpmObserver.prototype.nextListener = function () {

	var that = this;
	jQuery('#yrmcolorbox').on("yrmPopupClose", function () {
		that.prepareNextOpen();
	});
};

YpmObserver.prototype.prepareNextOpen = function () {

	this.list.shift();
	this.currentId = this.list[0];
	this.openCurrent();
};

YpmObserver.prototype.openPopup = function(popupId) {

	if(typeof YPM_DATA[popupId] == 'undefined') {
		return;
	}
	var obj = {};
	var data = YPM_DATA[popupId];

	if(typeof data['ypm-popup-exit-enable'] != 'undefined' && data['ypm-popup-exit-enable'] == 'on') {
		obj = new YpmExit();
		obj.setPopupData(data);
		obj.setPopupId(popupId);
		obj.openByExitMode();
	}
	else {
		obj = new YpmPopup();
		obj.setPopupData(data);
		obj.setPopupId(popupId);
		obj.onLoad();
	}
};

jQuery(document).ready(function () {

		var obs = new YpmObserver();
		obs.init();
});
