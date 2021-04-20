var myodometer = function() { this.init(); };

myodometer.prototype = {

	init: function () { 
		var $this = this;
		if(jQuery.browser.mobile || !this._setVars()) return;
		this._initOdometer();
		this._setEvents();
	},
   
	_setVars: function() { 
		var $this = this;
		
    	this._containers = $('.jsOdometer');
    	if(!this._containers) return false;
		
    	return true;
	},
	
	_initOdometer: function() {
		var $this = this;

		this._odometersObjArr = [];
		this._containers.each(function(idx, val) {
			var _val = $(this).text(),
				_format = $(this).data('format'),
				_n = 0;
			
			if(_format && _format === 'float') {
				_format = '(ddd)';
				
				 _n = Math.max(_val.lastIndexOf(','), 0);
				
				if(_n > 0) {
					_n = _val.length - _n - 1;
					_format += ",";
				}
				
				for (_n; _n > 0; _n--) _format += "d";
			}
			else {
				_val = _val.replace(',', '');
				_format = '(,ddd)';
			}
			
			$(this).data("dest-val", _val);
			$(this).text($this._getInitValue(_val));
			
			$this._odometersObjArr[idx] = new Odometer({
			  el: $(this)[0],
			  format: _format,
			  duration: 8000,
			  value: $this._getInitValue(_val),
			});
		});
	},
	
	_getInitValue: function(val) {
		var result = "1", 
			l = val.length;
		
		for (var i = 1; i < l; i++) {
			result += (val[i] === ',' ? ',' : '0');
		}
		
		return result;
	},
   
	_setEvents: function() {
		var $this = this;
		
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
			
			if($(this).is(':visible') && _scrollValue > _objTop) $this._startAnimObj($(this));
		});
	},
	
	_startAnimObj: function(obj) {
		var _val = obj.data("dest-val");
		
		obj.text(_val);
	},
	
	_startAnimAll: function() {
		var $this = this;
		
		$this._containers.each(function() {
			var _val = $(this).data("dest-val");
			
			$(this).text(_val);
		});
	}
};