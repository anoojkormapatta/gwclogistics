var printing = function() { this.init(); };

printing.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
	
	_setVars: function() { 
		var $this = this;
		
	 	this._buttons = $('.jsPrint');
	 	if(!this._buttons.length) return false;
	 	
	 	return true;
	},
	
	_setEvents: function() {
		var $this = this;
		
		this._buttons.on('click', function(e) {
			e.preventDefault();
			
			window.print();
		});
	}
};