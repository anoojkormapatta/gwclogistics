var scroll = function() { this.init(); };

scroll.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._initScroll();
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._containers = $('.h-scrollable, .gallery-scrollable');
    	if(!this._containers) return false;
		
    	return true;
	},
   
	_initScroll: function() {
		var $this = this,
			sum = 0;
		
		this._containers.each(function(idx, val) {
			var element = $(this).mCustomScrollbar({ axis: 'x', theme: 'dark-thick', documentTouchScroll: true, advanced: { updateOnContentResize: false, updateOnBrowserResize: false } });
			
			$this._initArabicPosition($(this));
		});
	},
	
	_setEvents: function() {
		var $this = this;
		
		$(window).on('resize orientationChange', function(event) { $this._resize(); });
		
		$(document).on('updateScrollPanels', function(e, updatePosition, ctx) {
			$this._resize(updatePosition, ctx);
		});
	},
	
	_initArabicPosition: function(element, ctx) {
		var context = ctx || $('body');
		
		if(document.rtl && element.closest(context).length) {
			element.mCustomScrollbar('scrollTo', 'right', {scrollInertia:0});
		}
	},
	
	_resize: function(updatePosition, ctx) {
	   var $this = this,
	   		position = updatePosition || 0;
	   
	   if(this.resizeTimer) clearTimeout(this.resizeTimer);
	    
	   this.resizeTimer = setTimeout(function() {
		   $this._containers.each(function(idx, val) {
			   $(this).mCustomScrollbar("destroy");
		   });
		   $this._initScroll();
	   }, 300);
   },
};