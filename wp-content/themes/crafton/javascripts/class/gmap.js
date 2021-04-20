var gmap = function() { this.init(); };

gmap.prototype = {

	init: function() {
		var $this = this;

		if(!this._setVars()) return;
		this._setEvents();

		window.initMap = function() {
			$this._initGoogleMap();
		};
	},

	_initGoogleMap : function(_coords, _zoom) {
		var $this = this,
			coords = _coords || { lat : this._container.data('lat'), lng : this._container.data('lng') },
			zoom = _zoom || 15,
			image,
			marker;

		this._map = new google.maps.Map(this._container[0], {
			center : coords,
			zoom : zoom,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			styles : [ {
				"featureType" : "water",
				"elementType" : "all",
				"stylers" : [ {
					"hue" : "#7fc8ed"
				}, {
					"saturation" : 55
				}, {
					"lightness" : -6
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "water",
				"elementType" : "labels",
				"stylers" : [ {
					"hue" : "#7fc8ed"
				}, {
					"saturation" : 55
				}, {
					"lightness" : -6
				}, {
					"visibility" : "off"
				} ]
			}, {
				"featureType" : "poi.park",
				"elementType" : "geometry",
				"stylers" : [ {
					"hue" : "#83cead"
				}, {
					"saturation" : 1
				}, {
					"lightness" : -15
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "landscape",
				"elementType" : "geometry",
				"stylers" : [ {
					"hue" : "#f3f4f4"
				}, {
					"saturation" : -84
				}, {
					"lightness" : 59
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "landscape",
				"elementType" : "labels",
				"stylers" : [ {
					"hue" : "#ffffff"
				}, {
					"saturation" : -100
				}, {
					"lightness" : 100
				}, {
					"visibility" : "off"
				} ]
			}, {
				"featureType" : "road",
				"elementType" : "geometry",
				"stylers" : [ {
					"hue" : "#ffffff"
				}, {
					"saturation" : -100
				}, {
					"lightness" : 100
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "road",
				"elementType" : "labels",
				"stylers" : [ {
					"hue" : "#bbbbbb"
				}, {
					"saturation" : -100
				}, {
					"lightness" : 26
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "road.arterial",
				"elementType" : "geometry",
				"stylers" : [ {
					"hue" : "#ffcc00"
				}, {
					"saturation" : 100
				}, {
					"lightness" : -35
				}, {
					"visibility" : "simplified"
				} ]
			}, {
				"featureType" : "road.highway",
				"elementType" : "geometry",
				"stylers" : [ {
					"hue" : "#ffcc00"
				}, {
					"saturation" : 100
				}, {
					"lightness" : -22
				}, {
					"visibility" : "on"
				} ]
			}, {
				"featureType" : "poi.school",
				"elementType" : "all",
				"stylers" : [ {
					"hue" : "#d7e4e4"
				}, {
					"saturation" : -60
				}, {
					"lightness" : 23
				}, {
					"visibility" : "on"
				} ]
			} ]
		});

		this._map.controls[google.maps.ControlPosition.TOP_RIGHT].push($this.getFull($this._map));

		image = {
			url : templateUrl+'/images/sources/marker.png',
			size : new google.maps.Size(102, 102),
			origin : new google.maps.Point(0, 0),
			anchor : new google.maps.Point(51, 51)
		};

		marker = new google.maps.Marker({
			position : $this._map.getCenter(),
			map : $this._map,
			icon : image
		});
	},

	_setVars: function() {
		var $this = this;

    	this._container = $('#map');
    	if(!this._container) return false;

    	return true;
	},

	_setEvents: function() {
		$('.jsViewLarger').on('click', function(e) {
			e.preventDefault();

			$('#map .fullScreen>div').trigger('click');
		});
	},

	getFull: function(map, enterFull, exitFull) {
	    if (enterFull === void 0) { enterFull = null; }
	    if (exitFull === void 0) { exitFull = null; }
	    if (enterFull === null) {
	        enterFull = "Full screen";
	    }
	    if (exitFull === null) {
	        exitFull = "Exit full screen";
	    }
	    var controlDiv = document.createElement("div");
	    controlDiv.className = "fullScreen";
	    controlDiv.index = 1;
	    controlDiv.style.padding = "5px";
	    controlDiv.style.display = 'none';
	    // Set CSS for the control border.
	    var controlUI = document.createElement("div");
	    controlUI.style.backgroundColor = "white";
	    controlUI.style.borderStyle = "solid";
	    controlUI.style.borderWidth = "1px";
	    controlUI.style.borderColor = "#717b87";
	    controlUI.style.cursor = "pointer";
	    controlUI.style.textAlign = "center";
	    controlUI.style.padding = "5px";
	    controlUI.style.boxShadow = "rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px";
	    controlDiv.appendChild(controlUI);
	    // Set CSS for the control interior.
	    var controlText = document.createElement("div");
	    controlText.style.fontFamily = "Roboto,Arial,sans-serif";
	    controlText.style.fontSize = "11px";
	    controlText.style.fontWeight = "400";
	    controlText.style.paddingTop = "1px";
	    controlText.style.paddingBottom = "1px";
	    controlText.style.paddingLeft = "6px";
	    controlText.style.paddingRight = "6px";
	    controlText.innerHTML = "<strong>" + enterFull + "</strong>";
	    controlUI.appendChild(controlText);
	    // set print CSS so the control is hidden
	    var head = document.getElementsByTagName("head")[0];
	    var newStyle = document.createElement("style");
	    newStyle.setAttribute("type", "text/css");
	    newStyle.setAttribute("media", "print");
	    var cssText = ".fullScreen { display: none;}";
	    var texNode = document.createTextNode(cssText);
	    try {
	        newStyle.appendChild(texNode);
	    }
	    catch (e) {
	        // IE8 hack
	        newStyle.styleSheet.cssText = cssText;
	    }
	    head.appendChild(newStyle);
	    var fullScreen = false;
	    var interval;
	    var mapDiv = map.getDiv();
	    var divStyle = mapDiv.style;
	    if (mapDiv.runtimeStyle) {
	        divStyle = mapDiv.runtimeStyle;
	    }
	    var originalPos = divStyle.position;
	    var originalWidth = divStyle.width;
	    var originalHeight = divStyle.height;
	    // IE8 hack
	    if (originalWidth === "") {
	        originalWidth = mapDiv.style.width;
	    }
	    if (originalHeight === "") {
	        originalHeight = mapDiv.style.height;
	    }
	    var originalTop = divStyle.top;
	    var originalLeft = divStyle.left;
	    var originalZIndex = divStyle.zIndex;
	    var bodyStyle = document.body.style;
	    var originalMarginTop = mapDiv.style.marginTop;
	    var originalDraggable = map.draggable;

	    if (document.body.runtimeStyle) {
	        bodyStyle = document.body.runtimeStyle;
	    }
	    var originalOverflow = bodyStyle.overflow;
	    controlDiv.goFullScreen = function () {
	        var center = map.getCenter();
	        mapDiv.style.position = "fixed";
	        mapDiv.style.width = "100%";
	        mapDiv.style.height = "100%";
	        mapDiv.style.top = "0";
	        mapDiv.style.left = "0";
	        mapDiv.style.zIndex = "100000";
	        mapDiv.style.maxHeight = "none";
	        mapDiv.style.border = "none";
	        mapDiv.style.marginTop = "0";
	        document.body.style.overflow = "hidden";
	        controlText.innerHTML = "<strong>" + exitFull + "</strong>";
	        controlDiv.style.display = 'inline-block';
	        fullScreen = true;
	        google.maps.event.trigger(map, "resize");
	        map.setCenter(center);
	        // this works around street view causing the map to disappear, which is caused by Google Maps setting the
	        // CSS position back to relative. There is no event triggered when Street View is shown hence the use of setInterval
	        interval = setInterval(function () {
	            if (mapDiv.style.position !== "fixed") {
	                mapDiv.style.position = "fixed";
	                google.maps.event.trigger(map, "resize");
	            }
	        }, 100);
	        map.setOptions({'draggable': true});
	    };
	    controlDiv.exitFullScreen = function () {
	        var center = map.getCenter();
	        if (originalPos === "") {
	            mapDiv.style.position = "relative";
	        }
	        else {
	            mapDiv.style.position = originalPos;
	        }
	        mapDiv.style.width = originalWidth;
	        mapDiv.style.height = originalHeight;
	        mapDiv.style.top = originalTop;
	        mapDiv.style.left = originalLeft;
	        mapDiv.style.zIndex = originalZIndex;
	        mapDiv.style.marginTop = originalMarginTop;
	        document.body.style.overflow = originalOverflow;
	        controlText.innerHTML = "<strong>" + enterFull + "</strong>";
	        controlDiv.style.display = 'none';
	        fullScreen = false;
	        google.maps.event.trigger(map, "resize");
	        map.setCenter(center);
	        map.setOptions({'draggable': originalDraggable});
	        clearInterval(interval);
	    };
	    // Setup the click event listener
	    google.maps.event.addDomListener(controlUI, "click", function () {
	        if (!fullScreen) {
	            controlDiv.goFullScreen();
	        }
	        else {
	            controlDiv.exitFullScreen();
	        }
	    });
	    return controlDiv;
	}
};
