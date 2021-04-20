var grid = function() { this.init(); };

grid.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
	
	_setVars: function() { 
		var $this = this;
		
	 	this._grid = $('.grid-with-links');
	 	if(!this._grid.length) return false;
	 	
	 	return true;
	},
	
	_setEvents: function() {
		var $this = this;
		
		this._grid.find('a').on('click', function(e) {
			e.stopPropagation();
			
			window.open($(this).attr('href'), ($(this).attr('target') == '_blank' ? '_blank' : '_self'));
		});
		
		this._grid.find('.column').on('click', function(e) {
			e.preventDefault();
			console.log('col');
			$(this).find('a').trigger('click');
		});
	}
};