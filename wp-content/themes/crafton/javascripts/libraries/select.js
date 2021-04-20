(function($, document, window) {
	"use strict";

	// close dropdown on clicking anywhere
	$(document).on("click.selectX", function () {
		$(".select-x").find("ul").removeClass("open");
	});

	var SelectX = function (element, options) {

		// extend default options, apply custom options
		options = $.extend({
			selected: null,
			animate: false
		}, options);

		// adding jQuery wrapper
		element = $(element).addClass("select-x");

		// self referencing element
		element.data("SelectX", this);

		// catching elements from the template
		var input = element.find("input"),
			trigger = element.find("button"),
			list = element.find("ul"),
			text = trigger.children().first(),
			items = list.find("li"),
			selected = null;

		// adding animation class
		if(options.animate) {
			list.addClass("select-x-" + options.animate);
		}

		// adding to this
		this.input = input;
		this.items = items;
		this.text = text;
		this.selected = selected;

		// select selected option
		if(options.selected !== null) {
			this.selectOption(options.selected);
		}

		// binding events
		trigger.click(function (e) {
			e.stopPropagation();
			e.preventDefault();

			// closing every other dropdown
			$(".select-x").each(function () {
				if($(this).has(trigger).length === 0) {
					$(this).find("ul").removeClass("open");
				}
			});

			// toggle list
			list.toggleClass("open");
			trigger.toggleClass("open");
		});

		// select option on click
		list.on("click", "li", function () {
			selected = $(this);
			options.selected = selected.data("value") || items.index(this);
			text.text(selected.text());
			selected.addClass("selected").siblings().removeClass("selected");
			input.val(selected.data("value")).closest('form').submit();
		});
	};

	SelectX.prototype.selectOption = function (value) {
		var items = this.items,
			text = this.text,
			selected = this.selected;

		// find selected option
		if(value === parseInt(value, 10)) {
			// find option by index
			selected = items.eq(value);
		}
		else {
			// find option by value
			items.each(function () {
				if($(this).data("value") === value) {
					selected = $(this);
				}
			});
		}
		text.text(selected.text());
		selected.addClass("selected").siblings().removeClass("selected");
	};

	$.fn.select = function () {
		var args = arguments;
		
		return this.each(function () {
			if($(this).data("SelectX")) {
				if(typeof args[0] === "string") {
					try {
						$(this).data("SelectX")[args[0]](args[1]);
					}
					catch(err) {
						console.error("Select Extended has no method " + args[0]);
					}
				} 
				else {
					console.error("Select Extended already initialized");
				}
			} 
			else {
				if(typeof args[0] === "object" || args[0] === undefined) {
					new SelectX(this, args[0]);
				}
			}
		});
	};
}(jQuery || window.jQuery, document, window));
