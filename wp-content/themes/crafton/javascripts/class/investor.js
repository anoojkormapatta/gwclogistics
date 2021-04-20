var investor = function() { this.init(); };

investor.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
	
	_setVars: function() { 
		var $this = this;
		
	 	this._sharedata = $('.content--sharedata');
	 	if(!this._sharedata.length) return false;
	 	
	 	return true;
	},
	
	_setEvents: function() {
		var $this = this;
		
		setInterval(function(){
			$.ajax(document.templateUrl+'/includes/ajax_sharedata.php', {
				cache: false,
				dataType: 'json',
				timeout: 5000,
				success: function(d) {
					//console.log(d);
					$this._sharedata.find('#wsLastTrade strong').html(d[0]);
					$this._sharedata.find('#wsChange strong').html(d[1]);
					$this._sharedata.find('#wsVolume strong').html(d[2]);
				}
			});
		}, 15000);
	}
};