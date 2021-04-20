var showFiles = function() { this.init(); };

showFiles.prototype = {

  init: function () {
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},

	_setVars: function(){
		this._downloadCategory = $('.download-category');

		return true;
	},

	_showFiles: function(item){
    item.toggleClass('visible');
		item.find('.download-items').slideToggle('medium', function(){});
	},

	_setEvents: function(){
		var $this = this;

		this._downloadCategory.on('click', function(){
			$this._showFiles($(this));
		});
	}

};
