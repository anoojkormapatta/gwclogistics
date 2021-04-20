var tabsURL = function() { this.init(); };

tabsURL.prototype = {

	init: function () {
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
		this._run();
	},

	_setVars: function() {
		var $this = this;

		this._link = $('.language a').attr("href");
		this._tabs = $(".tabs > div");
		this._tabsContent = $(".tabs-content > div");
		this._tabsLabel = $('.tabs > div');

		this._newLink = "";
		this._hash = window.location.hash.replace(new RegExp("^[#]+"), "");
		this._activeTab = "";

	 	return true;
	},

	_changeUrl: function(item){
		$('.language a').attr("href", this._link + item);
	},

	_run: function() {
		var $this = this,
			item,
			parent;

		if( this._hash !== '' && this._hash !== '#' ){
			item = this._tabs.filter('[data-rel="'+this._hash+'"]');

			if(!item.length) return false;

			$this._activeTab = this._hash;
		}
		else {
			return false;
		}

		if((parent = item.closest('.tab-panel').parent().closest('[id^="tp"]')) && parent.length) {
			parent.parent().prev('.tabs').children('[data-rel="'+parent.attr('id')+'"]').trigger('click');
		}
		item.trigger('click');

		this._changeUrl('#'+this._hash);
		
		setTimeout(function() { $("html, body").scrollTop('0px'); }, 0);
	},

	_setEvents: function() {
		var $this = this;
		
		//$(window).on("hashchange", function(e) { e.preventDefault(); });

		this._tabs.on('click', function(){
			var hash = '#' + $(this).data("rel");

			$this._changeUrl(hash);

			if(history.pushState) {
			    history.pushState(null, null, hash);
			}
			else {
			    window.location.hash = hash;
			}
		});
	}
};
