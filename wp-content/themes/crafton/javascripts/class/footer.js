var footer = function() { this.init(); };

footer.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._container = $('footer');
    	if(!this._container) return false;
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this;
		
		$('.title', $this._container).on('click', function(e) {
			e.preventDefault();
			
			if($('.icon-arrow-up:visible', $(this)).length) {
				if($(this).next().is(':visible')) {
					$(this).next().slideUp(400, function() { $(this).parent().find('.icon-arrow-up').removeClass('imp-up'); });
				}
				else {
					$(this).next().slideDown(400, function() { $(this).parent().find('.icon-arrow-up').addClass('imp-up'); });
				}
			}
		});
		
		$('.jsGo-top').on("click", function(e) {
			e.preventDefault();
			$("html, body").animate({scrollTop: 0 }, 500);
		});
		
		$('.jsSocial-it').on("click", function(e) {
			e.preventDefault();
			
			var context = $('.social-wrapper'),
				container = $('.social', $(this));
			
			if(context.is(':visible')) {
				context.hide();
			}
			else {
				var position = (($('html').attr('dir') === 'rtl') ? 'left' : 'right'),
					map = { top: (container.offset().top - context.height() - 10)+'px' };
				
				map[position] = '55px';
				
				context.css(map).show();
			}
		});
   },
};