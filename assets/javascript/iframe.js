function YpmIframe() {

	this.width = '';
	this.height = '';
	this.url = '';
	this.init();
	this.changeListener();
}

YpmIframe.prototype.init = function () {

	if(jQuery('#iframe-url').length) {
		this.url = jQuery('#iframe-url').val();
	}
	if(jQuery('#iframe-width')) {
		this.width = jQuery('#iframe-width').val();
	}
	if(jQuery('#iframe-height')) {
		this.height = jQuery('#iframe-height').val();
	}

	this.buildIframe();
};

YpmIframe.prototype.buildIframe = function () {

	var iframe = document.createElement("iframe");
	iframe.setAttribute("src", this.url);
	iframe.style.width = this.width;
	iframe.style.height = this.height;

	jQuery('.iframe-preview-wrapper').html('');
	jQuery('.iframe-preview-wrapper').html(iframe);
};

YpmIframe.prototype.changeListener = function () {

	if(!jQuery('.ifrane-setting').length) {
		return false;
	}

	var that = this;
	jQuery('.ifrane-setting').change(function () {
		that.init();
	});
};

jQuery(document).ready(function () {
	var iframeObj = new YpmIframe();
});