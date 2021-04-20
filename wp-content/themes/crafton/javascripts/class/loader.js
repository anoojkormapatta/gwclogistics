var loader = function() { this.init(); };

loader.prototype = {

	init: function () {
		if(!this._setVars()) return;
		this._run();
	},
	
	_setVars: function() { 
		var $this = this;
		
		this._body = $('body');
		if(!this._body.length) return false;

		this._container = $('.jsLoader');
		if(!this._container.length) return false;

		return true;
	},
	
	_run: function() {
		var $this = this;
		
		imagesLoaded('.jsLoader', function(instance) {
			$this._container.addClass("hide");
			setTimeout(function() {
	            $this._container.addClass("hidden");
	        }, 250);
      });
	}
};