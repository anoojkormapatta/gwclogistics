var news = function() { this.init(); };

news.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
		
		setTimeout(function() {
			$this._refreshLayout();
		}, 300);
	},
	
	_setVars: function() { 
		var $this = this;
		
	 	this._news = $('article.news-block');
	 	if(!this._news.length) return false;
		
	 	this._history = $('.news-block~.history');
	 	if(!this._history.length) return false;
	 	
	 	this._introExist = !!this._history.siblings('.intro').length;
	 	
	 	this._navigation = $('.news-block~.article-navigation');
	 	
	 	return true;
	},
	
	_setEvents: function() {
		var $this = this;
		
		$(window).on('resize orientationChange', function(event) { $this._resize(); });
	},
	
	_resize: function() {
		var $this = this;
		
		if(this.resizeTimer) clearTimeout(this.resizeTimer);
		 
		this.resizeTimer = setTimeout(function() {
			$this._refreshLayout();
		}, 300);
	},
	
	_refreshLayout: function() {
		var $this = this,
			minHeight = (!this._introExist ? (this._news.first().offset().top - this._history.position().top) : 0);
	
		if(this._navigation.length) {
			minHeight += this._navigation.outerHeight(true); 
		}
		
		this._news.each(function() {
			minHeight += $(this).outerHeight();
		});
		
		var offset = 0;
		
		if(this._history.height() > minHeight) {
			offset = this._history.height() - minHeight;
		}
		
		if(this._navigation.length) {
			this._navigation.css('margin-bottom', offset+'px'); 
		}
		else {
			this._news.last().css('margin-bottom', offset+'px');
		}
	}
};