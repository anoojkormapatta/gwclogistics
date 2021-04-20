var ddlist = function() { this.init(); };

ddlist.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._containers = $('.ddlist');
    	if(!this._containers) return false;
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this;
		
		this._containers.each(function() {
			$(this).select({
				selected: null,
				animate: "slide"
			});
		});
   }
};