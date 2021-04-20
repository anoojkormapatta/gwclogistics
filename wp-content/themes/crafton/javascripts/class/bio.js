var showBio = function() { this.init(); };

showBio.prototype = {

  init: function () {
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},

  _setVars: function() {
		var $this = this;
		
	    this._bio = $('.team__member');
	    this._bioButton = this._bio.find('.show-bio');
	    this._bioContent = this._bio.find('.bio-info');
	
	    return true;
	},

  _setEvents: function() {
		var $this = this;
		
	    this._bioButton.click(function(){
	      var i = $(this).attr('data-bioid');
	      $this._bioContent.filter('[data-bioid="'+i+'"]').fadeToggle('.bio--visible');
	    });
	}
};
