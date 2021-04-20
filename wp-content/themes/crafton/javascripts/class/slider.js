var slider = function() { this.init(); };

slider.prototype = {

	init: function () { 
		if(!this._setVars()) return;
		this._setEvents();
		this._resize();
	},
   
	_setVars: function() { 
		var $this = this;
		
		this._youtubeFrame = $('.youtubeFrame');
		if(!this._youtubeFrame) return false;
		
    	this._container = $('.jsBxslider');
    	if(!this._container) return false;
    	
		this._sliders = [];
		
    	return true;
	},
   
	_setEvents: function() {
		var $this = this,
			options = {
				adaptiveHeight: true,
				auto: true,
				pause: 8000,
				controls: false,
				touchEnabled: false
			};
		
			$this._container.each(function(idx) {
				var _slider = $(this);
				options.touchEnabled = $(this).closest('.full-height').length > 0 || jQuery.browser.mobile;
				$this._sliders[idx] = $(this).bxSlider(options);
				
				$('svg', $(this)).on('click', function(e) {
					e.preventDefault();
					
					var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,
			        	match = ($(this).parent().data('youtube') !== undefined && $(this).parent().data('youtube').match(regExp)),
			        	ytVideo = '';
					
			        if ( match && match[7].length == 11 ){
			            ytVideo = ( typeof(match[7])!='undefined' ) ? match[7] : '';
			        }
			        else {
			        	return false;
			        }
					
					$this._youtubeFrame.clone().removeClass('youtubeFrame').attr('id', 'youtubeFrame').insertAfter($this._youtubeFrame);
					
					var player = new YT.Player('youtubeFrame', {
						playerVars: {
							autoplay: 1,
							enablejsapi: 1,
							origin: window.location.protocol+'//'+window.location.hostname,
							playsinline: 0,
							rel: 0,
							showinfo: 0,
							iv_load_policy: 3,
							modesbranding: 0,
							color: 'white',
							controls: 1
						},
						height: 1920,
						width: 979,
						videoId: ytVideo,
					});
					
					$('#youtubeFrame').addClass('visible').next('.youtubeClose').data('player', player);
					$('body').addClass('youtube');
					
					$this._sliders[idx].stopAuto();
				});
			});
		
		$(document).on('click', '.youtubeClose', function(e) {
			e.preventDefault();
			
			if($(this).data('player')) {
				var player = $(this).data('player');
				
				player.stopVideo();
				player.destroy();
				$('#youtubeFrame').remove();
				$('body').removeClass('youtube');
				
				$(this).removeData('player');
				
				$.each($this._sliders, function(i, v) {
					v.startAuto();
				});
			}
		});
		
		$this._resizeTimeout = null;		
		$(window).on('resize orientationChange', function(event) { 
			if($this._resizeTimeout !== null){
	    		clearTimeout($this._resizeTimeout);
	            $this._resizeTimeout = null;
	        }
	        $this._resizeTimeout = setTimeout(function(){
	            $this._resize();
	        }, 200); 
		});
   },
   
   _viewport: function() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return e[ a+'Width' ];
	},
   
   _resize: function() {
	   var $this = this;
	   
	   $this._container.each(function(idx) {
			var box = $(this).closest('.full-height'),
				tmp;
			
			if(box.length) {
				var slider = $this._sliders[idx];
				
				slider.reloadSlider(); 
				
				if($this._viewport() > 1100) {
					var relativeContainer = box.children().first();
					if((tmp = box.parent().height()) != relativeContainer.height()) {console.log(tmp);
						relativeContainer[0].setAttribute('style', 'max-width: 100%; height: '+tmp+'px !important;');
					}
				}
				else {
					box.children().first()[0].setAttribute('style', 'max-width: 100%;');
				}
			}
	   });
   }
};