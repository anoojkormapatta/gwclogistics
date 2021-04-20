var collapse = function() { this.init(); };

collapse.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._container = $('.offers');
    	if(!this._container) return false;
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this;
		
		$('.title a', this._container).on('click', function(e) {
			e.preventDefault();
			
			var item = $(this).closest('.title').find('~.offer-details');
			if(item.height() === 0) {
				item.css('max-height', '1000px');
			}
			else {
				item.css('max-height', '0px');
			}
			
		});
		
   }
};