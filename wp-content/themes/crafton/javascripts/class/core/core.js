var core = function() { this.init(); };

core.prototype = {
	init: function() {
		this._run();
	},

	_run: function() {
		document.rtl = $('html').is('[dir="rtl"]');

		document.header = new header();
		document.slider = new slider();
		document.tabpanel = new tabpanel();
		document.footer = new footer();
		new myodometer();
		new charts();
		new scroll();
		new articleGallery();
		new collapse();
		new ddlist();
		new showBio();
		new showActiveItem();
		new showFiles();
		new news();
		new investor();
		new grid();
		new loader();
		new printing();
		new socials();
		new tabsURL();
		new SplashScreen();

		// document.cftn = {};
		// document.cookies = new Cookies();
	}
};

function setCookie(name, value, days){
	var date = new Date();
	date.setTime(date.getTime() + (days*24*60*60*1000));
	var expires = "; expires=" + date.toGMTString();
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

new gmap(); //before async script loaded

$(document).ready(function() {
	new core();
});

