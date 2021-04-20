var socials = function() { this.init(); };

socials.prototype = {

	init: function () { 
		var $this = this;
		if(!this._setVars()) return;
		this._setEvents();
	},
	
	_setVars: function() { 
		var $this = this;
		
	 	this._socials = $('.jsShare-it');
	 	if(!this._socials.length) return false;
	 	
	 	return true;
	},
	
	_setEvents: function() {
		var $this = this;
		
		this._socials.on('click', function(e) {
			e.preventDefault();
			
			if($(this).siblings('.social-items').length) {
				$(this).siblings('.social-items').remove();
			}
			else {
				$(this).before($this._getSocialItems($(this)));
			}
		});
	},
	
	_getSocialItems: function(_rel) {
		var items = $('<div class="social-items"></div>'),
			url = _rel.data('href') ? _rel.data('href') : window.location.href,
			title = _rel.data('title') ? _rel.data('title') : $('head>title').text(),
			item;

		item = $('<div class="inline social-item"><a class="fb trans" target="_blank"><svg class="icon icon-facebook" style="font-size: 24px; margin: 0 5px;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use></svg></a></div>');
		item.find('a').on('click', function(e) {
			e.preventDefault();
			
			FB.ui({
				method: 'share',
				href: url,
			}, function(response){ if(response && response.error_message) { console.log( response.error_message.replace(/\+/g, ' '), 'error'); } });
		});
		
		items.append(item);
		
		item = $('<div class="inline social-item"><a class="tt trans" target="_blank"><svg class="icon icon-twitter" style="font-size: 24px; margin: 0 5px;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use></svg></a></div>');
		item.find('a').on('click', function(e) {
			e.preventDefault();
			
			title = title.replace(';', ' - ');
			var href = encodeURI('https://twitter.com/intent/tweet?url='+url+'&hashtags=gwc&text='+title);
			
			window.open(href, '_blank');
		});
		
		items.append(item);
		<a href="https://api.whatsapp.com/send?text=urlencodedtext" target="_blank">WA</a>
		return items;
	}
};