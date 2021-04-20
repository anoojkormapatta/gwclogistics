var SplashScreen = function() {
	this.init();
};


SplashScreen.prototype = {

	init: function() {
		if (!this._setVars()) return;
		this._setEvents();
	},

	_setVars: function(){
		this._splash = $('.jsSplash');
		if (!this._splash.length) return false;
		this._closeSplash = this._splash.find('.jsCloseSplash');

		console.log('splash init...');

		return true;
	},

	_close: function(){
		this._splash.removeClass('active');
		setCookie('splash', true, 300);
	},

	_setEvents: function(){
		var t = this;

		t._closeSplash.on('click', function(){
			t._close();
		});
	}
};
