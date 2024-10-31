function YpmAdminJs() {

	this.colorpicker();
	this.accordion();
	this.upgradePro();
	this.select2();
	this.tabEvenetsListener();
}

YpmAdminJs.prototype.tabEvenetsListener = function() {

	if (!jQuery('.nav-tabs a').length) {
		return false;
	}

	jQuery('.nav-tabs a').on('shown.bs.tab', function(event){
		var href = jQuery(this).attr('href');
		var id = href.replace('#', '');
		jQuery('.ypm-facebook-type').val(id);
	});
};

YpmAdminJs.prototype.select2 = function () {
	jQuery('.js-basic-select').select2();
};

YpmAdminJs.prototype.colorpicker = function() {

	jQuery('.ypm-color-picker').wpColorPicker();

	jQuery("#range").ionRangeSlider({
		hide_min_max: true,
		keyboard: true,
		min: 0,
		max: 1,
		type: 'single',
		step: 0.1,
		prefix: "",
		grid: true
	});
};

YpmAdminJs.prototype.accordion = function () {

	var that = this;
	var element = jQuery(".js-ypm-accordion");
	element.each(function() {
		that.checkboxAccordion(jQuery(this));
	});

	element.click(function() {
		var elements = jQuery(this);
		that.checkboxAccordion(jQuery(this));
	});
};

YpmAdminJs.prototype.checkboxAccordion = function (element) {

	if(!element.is(':checked')) {
		element.parents('.row').first().nextAll("div").first().css({'display': 'none'});
	}
	else {
		element.parents('.row').first().nextAll("div").first().css({'display':'block'});
	}
};

YpmAdminJs.prototype.upgradePro = function () {
	jQuery('.yrm-pro-options').on('click', function() {
		window.open('http://edmion.esy.es/popup-maker/');
	});
};

jQuery(document).ready(function() {
	var obj = new YpmAdminJs();
});