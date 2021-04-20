var Cookies = function() {
	this.init();
};

Cookies.prototype = {

	init: function() {
		var $this = this;
		if (!this._setVars())
			return;
		this._setEvents();
	},

	_setVars: function() {
		this.cookie = $('.cookiesBox');
		if (!this.cookie.length) return false;

		this.cookieCookie = this.cookie.find('.button');
		return true;
	},

	_setEvents: function() {

		var t = this;

		t.cookieCookie.click(function() {
			t.cookie.addClass('removed');

			setTimeout(function() {
				t.cookie.remove();
			}, 500);

			setCookie('cookies', 1, 30);
		});
	}
};