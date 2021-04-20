var articleGallery = function() { this.init(); };

articleGallery.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._container = $('article .gallery:not(.noJs)');
    	if(!this._container) return false;
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this;
		
		$('h4+a', $this._container).on('mouseenter', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			$(this).next('a').addClass('hover');
		}).on('mouseleave', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			$(this).next('a').removeClass('hover');
		}).on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			$(this).next('a').trigger('click');
		});
		
		$('a[href]', $this._container).on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			var postId = $(this).data('postid');
			
			$.colorbox({href: myAjaxUrl, data : { action: 'ajax_product', security: myNonce, post_id: postId }, width: '90%', maxWidth: '90%', maxHeight: '90%', close: '&times;', fixed: true});
			
		});
		
		$(document).on('cbox_complete', function(){
		    $('#colorbox #cboxLoadedContent').mCustomScrollbar({ theme: 'dark-thick' });
		});
		
		$(window).on('resize orientationChange', function(event) { $this._resize(); });
   },
   
   _resize: function() {
	   var $this = this;
	   
	   if(this.resizeTimer) clearTimeout(this.resizeTimer);
	    
	   this.resizeTimer = setTimeout(function() {
		   if($('#cboxOverlay').is(':visible')) {
			   $.colorbox.resize({width:'90%', height:'90%'});
	       }
	   }, 300);
   }
};