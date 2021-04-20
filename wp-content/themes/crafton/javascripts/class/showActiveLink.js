var showActiveItem = function() { this.init(); };

showActiveItem.prototype = {

  init: function () {
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},

	_setVars: function(){
		this._menu = $('.menu');
		this._menuLinks = this._menu.find('a');

		return true;
	},

	_checkCurrentURL: function(){
		var i = window.location.href;

		this._menuLinks.each(function(){
			if(i == $(this).attr("href")){

				if(!$(this).parent().hasClass('menu')){
					$(this).closest('.submenu').prev().addClass('active');
				}

				else{
					$(this).addClass('active');
				}
			}
		});
	},

	_setEvents: function(){
		var $this = this;
		$this._checkCurrentURL();

	}

};
