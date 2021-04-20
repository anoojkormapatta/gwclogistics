var tabpanel = function() { this.init(); };

tabpanel.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._container = $('.tab-panel');
    	if(!this._container) return false;
    	
    	this._liveStreamButton = $('#liveStreamBtn');
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this;
		
		this._liveStreamButton.on('click', function(e) {
			e.preventDefault();
			
			$("html, body").animate({scrollTop: ($('.content--sharedata').offset().top-150)+'px' }, 500);
		});
		
		$('.tab-panel .tabs>div').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			if($(this).hasClass('active')) {
				return false;
			}
			
			$(this).addClass('active').siblings().removeClass('active');
			
			if($(this).closest('.tab-panel').hasClass('accordion')) {
				$(this).next().css('display', 'none').addClass('active').slideDown(400, function() { 
					
					if($('.jsBxslider', $(this)).length) { 
						var context = $('.jsBxslider', $(this)); 
						
						$.each(document.slider._sliders, function(i, v) { 
							v.reloadSlider(); 
						}); 
					}
					
					$(document).trigger('updateScrollPanels', 1, $(this));
					
					$("html, body").animate({scrollTop: ($(this).position().top-150)+'px' }, 500);
				});
			}
			else {
				$(this).parent().next('.tabs-content').children('#'+$(this).data('rel')).css('display', 'none').addClass('active')
					.slideDown(400, function() { 
						
						if($('.jsBxslider', $(this)).length) { 
							var context = $('.jsBxslider', $(this)); 
							
							$.each(document.slider._sliders, function(i, v) { v.reloadSlider(); }); 
						}

						$(document).trigger('updateScrollPanels', 1, $(this));
						
					}).siblings().removeClass('active');
			}
			
			if($('.icon-arrow-up:visible', $(this)).length) {
				if($(this).next().is(':visible')) {
					$(this).next().slideUp(400, function() { $(this).parent().find('.icon-arrow-up').removeClass('imp-up'); });
				}
				else {
					$(this).next().slideDown(400, function() { $(this).parent().find('.icon-arrow-up').addClass('imp-up'); });
				}
			}
			
			$this._resize();
		});
		
		$(window).on('resize orientationChange', function(event) { $this._resize(); });
		
		$this._resize();
   },
   
   _viewport: function() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return e[ a+'Width' ];
	},
   
   _resize: function (){
	   var $this = this,
	   		cssProperty = document.rtl ? 'margin-right' : 'margin-left';
	   
	   if($this._viewport() <= 900) {
		   $('.tab-panel:not(.accordion)').each(function() {
			   var panel = $(this),
			   		tabs = panel.find('>.tabs').removeClass('scrollable');
			   
			   tabs.find('.prevBtn, .nextBtn').remove();
			   tabs.find('[data-rel]:first-child').css('margin-left', '0px');
			   
			   panel.find('>.tabs-content>*').each(function() {
				   var id = $(this).attr('id');
				   
				   $(this).insertAfter(tabs.find('[data-rel="'+id+'"]'));
			   });
			   panel.addClass('accordion');
		   });
	   }
	   else {
		   $('.tab-panel.accordion').each(function() {
			   var panel = $(this),
			   		content = panel.find('>.tabs-content');
			   
			   panel.find('>.tabs>[data-rel]+:not([data-rel])').each(function() {
				  $(this).appendTo(content);
			   });
			   $(this).removeClass('accordion');
		   });
		   
		   $('.tab-panel').each(function() {
			   var panel = $(this),
			   		tabs = panel.find('>.tabs:not(.visible-block)>[data-rel]'),
			   		width = panel.width(),
			   		tabsWidth = tabs.outerWidth();
			  
			   if(tabsWidth <= 0) {
				   return true;
			   } 
			   
			   if(tabsWidth <= 120) {
				   if(panel.find('>.tabs:not(.scrollable)').length) {
					   var context = panel.find('>.tabs');
					   
					   context.addClass('scrollable').append('<div class="prevBtn">&#8249;</div><div class="nextBtn" disabled>&#8250;</div>');
					   
					   $('.prevBtn', context).on('click', function(e) {
						   e.preventDefault();
						   
						   var width = $(this).closest('.tab-panel').width(),
						   		workingWidth = (width - 100) / 2,
						   		child = $(this).siblings('[data-rel]:first-child');
						   		offset = parseInt(child.css(cssProperty), 10);
						   
						   		if(offset + workingWidth > 50) {
						   			child.css(cssProperty, '50px');
						   			$(this).attr('disabled', '');
						   		}
						   		else {
						   			child.css(cssProperty, (offset + workingWidth)+'px');
						   		}
						   		
						   		$(this).siblings('.nextBtn').removeAttr('disabled');
					   });
					   
					   $('.nextBtn', context).on('click', function(e) {
						   e.preventDefault();
						   
						   var width = $(this).closest('.tab-panel').width(),
						   		workingWidth = (width - 100) / 2,
						   		child = $(this).siblings('[data-rel]:first-child');
						   		offset = parseInt(child.css(cssProperty), 10);
						   
						   		if(offset - workingWidth < -((tabs.length * 122) - width + 50)) {
						   			child.css(cssProperty, -((tabs.length * 122) - width + 50)+'px');
						   			$(this).attr('disabled', '');
						   		}
						   		else {
						   			child.css(cssProperty, (offset - workingWidth)+'px');
						   		}
						   		
						   		$(this).siblings('.prevBtn').removeAttr('disabled');
					   });
					   
					   if(document.rtl) {
						   tabs[0].style.marginRight = -((tabs.length * 122) - width + 50)+'px';
					   }
					   else {
						   tabs[0].style.marginLeft = -((tabs.length * 122) - width + 50)+'px';
					   }
				   }
				   else {
					   if(tabsWidth === 120 && width > tabs.length * 122) {
						   if(panel.find('>.tabs.scrollable').length) {
							   panel.find('>.tabs').removeClass('scrollable').find('.prevBtn, .nextBtn').remove();
							   
							   tabs[0].style.marginLeft = '0px';
						   }
					   }
				   }
			   }
			   else {
				   if(panel.find('>.tabs.scrollable').length) {
					   panel.find('>.tabs').removeClass('scrollable').find('.prevBtn, .nextBtn').remove();
					   
					   tabs[0].style.marginLeft = '0px';
					   tabs[0].style.marginRight = '0px';
				   }
			   }
			   
		   });
	   }
   }
};