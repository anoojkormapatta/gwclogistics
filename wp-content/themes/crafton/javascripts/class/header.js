var header = function() { this.init(); };

header.prototype = {

	init: function () {
		var $this = this;

		if (jQuery.browser.mobile) {
			$('body').addClass('mobile');
		}

		this._menuExpanded();

		$('.jsSubmit').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();

			$(this).closest('form').submit();
		});

		if (!this._setVars()) return;
		this._setEvents();
	},

	_setVars: function() {
		var $this = this;

    	this._container = $('.jsSearch');
    	if (!this._container) return false;

    	this._input = this._container.find('input');
    	this._header = $('body>header');
    	this._hamburgerWrapper = $('.hamburger-wrapper');
    	this._menu = $('.menu');

    	return true;
	},

	_setEvents: function() {
		var $this = this;

		$('.icon-Search', this._container).on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();

			$this._toggleSearch();

			/*if (e.target == this) {
				$this._toggleSearch();
			}*/
		});

		$('input', this._container).on('blur', function(e) {
			e.stopPropagation();

			$(this).siblings('.icon-Search').trigger('click');
		});

		$('.hamburger', this._header).on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();

			$this._toggleMenu();
		});

		//if (!jQuery.browser.mobile)
			$(window).on("scroll", function(e) {
				if ($(this).scrollTop() === 0) {
					$this._header.removeClass("pinned");
				}
				else {
					$this._header.addClass("pinned");
				}
			});

		$(window).on('resize orientationChange', function(event) { $this._resize(); });
   },

   _menuExpanded: function() {
	   $('.menu a.expanded').on('touchstart', function(e) {
			e.preventDefault();
			e.stopPropagation();

			var linkClone = $(this).clone();

			$(this).off('click').toggleClass('s-up').next('.submenu').toggleClass('hover').find('div:not(.picture) a').each(function() { if ($(this).text() === linkClone.text()) return false; $(this).before(linkClone); return false; });

		});
   },

   _toggleSearch: function() {
	   var $this = this;

	   if (this._container.hasClass('active')) {
		   this._container.removeClass('active');
	   }
	   else {
		   this._container.addClass('active');
		   this._container.find('input[type=search]').focus();
	   }
   },

   _toggleMenu: function() {
	   var $this = this,
	   		header;

	   if (this._menu.is(':visible')) {
		   header = this._menu.removeClass('below flex').closest('header'); //remove flex when add in html directly
		   if (header.css('max-height') === '100%') {
			   $('body').css('overflow-y', 'auto');
		   }
		   header.removeClass('below-menu');
	   }
	   else {
		   header = this._menu.addClass('below flex').closest('header'); //remove flex when add in html directly
		   header.addClass('below-menu');
		   if (header.css('max-height') === '100%') {
			   $('body').css('overflow-y', 'hidden');
		   }
	   }
   },

   _resize: function() {
	   var $this = this;
	   if (!this._hamburgerWrapper.is(':visible')) {
		   this._menu.removeClass('below');
		   this._header.removeClass('below-menu');
	   }

	   if (this._menu.is(':visible') && this._menu.closest('header').css('max-height') === '100%') {
		   $('body').css('overflow-y', 'hidden');
	   }
	   else {
		   $('body').css('overflow-y', 'auto');
	   }
   }
};