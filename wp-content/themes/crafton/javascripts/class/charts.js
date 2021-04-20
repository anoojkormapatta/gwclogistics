var charts = function() { this.init(); };

charts.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._initCharts();
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._containers = $('.chart-wrapper .pieContainer');
    	if(!this._containers) return false;
		
    	return true;
	},
	
	_initCharts: function() {
		var $this = this;

		this._containers.each(function(idx, val) {
			
			$(this).prepend('<div class="pieBackground"></div>'+
					'<div class="pieBackground2"></div>'+
					'<div class="pieBackground3"></div>'+
					'<div class="pieBackground4"></div>'+
					'<div class="pieSlice1 hold"><div class="pie"></div></div>'+
					'<div class="pieSlice2 hold"><div class="pie"></div></div>'+
					'<div class="pieSlice3 hold"><div class="pie"></div></div>'+
					'<div class="pieSlice4 hold"><div class="pie"></div></div>');
			
		});
	},
   
	_setEvents: function() {
		var $this = this;
		
		if(jQuery.browser.mobile) {
			this._containers.each(function(idx, val) {
				
				$(this).find('.pieSlice3 .pie').css({
						'-webkit-transition': 'all 0s ease 0s',
				   		'transition': 'all 0s ease 0s'
				});
				
				$this._startAnimObj($(this));
			});
			
		}
		
		$this._timeoutHandle = null;
		
		$(window).scroll(function() {
			if(null !== $this._timeoutHandle) { 
				clearTimeout($this._timeoutHandle);
				$this._timeoutHandle = null;
			}
			
			$this._timeoutHandle = setTimeout(function() {
				$this._onScroll();
			}, 160);
		});
   },
   
   _onScroll: function() {
		var $this = this, 
			_scrollValue = $(window).scrollTop() + $(window).height() - 10;
		
		this._containers.each(function() {
			var _objTop = $(this).offset().top;
			
			if(_scrollValue > _objTop) $this._startAnimObj($(this));
		});
	},
	
	_startAnimObj: function(obj) {
		var _max = ($('.label', obj).data("max") ? parseInt($('.label', obj).data("max")) : 100),
			_val = parseInt($('.label', obj).text()),
			_chart = $('.pieSlice3 .pie', obj),
			_multiplier = (document.rtl ? 1 : -1);
		
		_max = Math.max(_max, _val);
		_val = _val / _max * 35 * _multiplier;
		
		_chart.css({
		   '-moz-transform': 'rotate('+(_val)+'deg)',
		   '-o-transform': 'rotate('+(_val)+'deg)',
		   '-ms-transform': 'rotate('+(_val)+'deg)',
		   '-webkit-transform': 'rotate('+(_val)+'deg)',
		   'transform': 'rotate('+(_val)+'deg)'
		});
	}
};