(function () {
	'use strict';

	//////////////
	// Constructor
	var SleekMap = function (mapEl, config) {
		this.mapEl = mapEl;
		this.config = config;
		this.markers = [];
		this.kmlLayers = [];

		// We will most likely need an info window
		this.infoWindow = new google.maps.InfoWindow();

		// Create bounds
		this.markerBounds = new google.maps.LatLngBounds();

		// Basic map options
		this.mapOptions = {
			zoom: this.config.zoom || 2,
			scrollWheel: this.config.scrollWheel || false,
			center: this.config.center || {lat: 0, lng: 0},
			mapTypeControl: false, // Will be true if more than one map type is specified
			streetViewControl: this.config.streetViewControl || false,
			styles: this.config.styles || null
		};

		// Add map types
		if (this.config.mapTypes && this.config.mapTypes.length) {
			// Just one type
			if (this.config.mapTypes.length === 1) {
				// Just a string, assume it's an existing mapTypeId
				if (typeof this.config.mapTypes[0] === 'string') {
					this.mapOptions.mapTypeId = this.config.mapTypes[0];
				}
				// Not a string - assumed to be a style object
				else {
					this.mapOptions.styles = this.config.mapTypes[0].styles;
				}
			}
			// Several types
			else {
				var mapTypeIds = [];

				// Show map type controls
				this.mapOptions.mapTypeControl = true;

				// Add all types
				for (var i = 0; i < this.config.mapTypes.length; i++) {
					if (typeof this.config.mapTypes[i] === 'string') {
						mapTypeIds.push(this.config.mapTypes[i]);
					}
					else {
						mapTypeIds.push('styled_map_' + this.config.mapTypes[i].name.replace(/\W/g, '_'));
					}
				}

				this.mapOptions.mapTypeControlOptions = {
					mapTypeIds: mapTypeIds
				};
			}
		}

		// Create the map
		this.map = new google.maps.Map(this.mapEl, this.mapOptions);

		// Now create the styled map types (because we need the map to do so)
		if (this.config.mapTypes && this.config.mapTypes.length > 1) {
			for (var i = 0; i < this.config.mapTypes.length; i++) {
				if (typeof this.config.mapTypes[i] !== 'string') {
					this.map.mapTypes.set(
						'styled_map_' + this.config.mapTypes[i].name.replace(/\W/g, '_'),
						new google.maps.StyledMapType(this.config.mapTypes[i].styles, {name: this.config.mapTypes[i].name})
					);
				}
			}
		}

		// Geolocation
		if (this.config.geolocation) {
			this.addGeolocation();
		}

		// Markers
		if (this.config.markers && this.config.markers.length) {
			this.addMarkers(this.config.markers);
		}

		// KML Layers
		if (this.config.kmlLayers && this.config.kmlLayers.length) {
			this.addKmlLayers(this.config.kmlLayers);
		}
	};

	///////////////
	// Geolocation
	SleekMap.prototype.addGeolocation = function () {
		var t = this;

		this.geolocationControl = document.createElement('div');
		this.geolocationControl.classList.add('sleek-map-geolocation');
		this.geolocationControl.addEventListener('click', function () {
			if (!t.geolocationMarker) {
				t.watchPosition();
			}
			else {
				t.map.panTo(t.geolocationMarker.getPosition());
			}
		});

		this.map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(this.geolocationControl);
	};

	// Setup geolocation watching
	SleekMap.prototype.watchPosition = function () {
		var t = this;

		this.geolocationControl.classList.remove('error');
		this.geolocationControl.classList.add('loading');

		this.geolocationId = navigator.geolocation.watchPosition(
			function (position) {
				t.geolocationControl.classList.remove('error');
				t.geolocationControl.classList.remove('loading');

				if (t.geolocationMarker) {
					t.updateGeolocationMarker({
						lat: position.coords.latitude,
						lng: position.coords.longitude
					}, position.coords.accuracy);
				}
				else {
					t.addGeolocationMarker({
						lat: position.coords.latitude,
						lng: position.coords.longitude
					}, position.coords.accuracy);

					t.map.panTo({
						lat: position.coords.latitude,
						lng: position.coords.longitude
					});
				}
			},
			function (error) {
				t.geolocationControl.classList.remove('loading');
				t.geolocationControl.classList.add('error');
			},
			{
				timeout: this.config.geolocation.timeout || 5000,
				maximumAge: this.config.geolocation.maximumAge || 0,
				enableHighAccuracy: this.config.geolocation.enableHighAccuracy || false
			}
		);
	};

	// Create marker and accuracy circle
	SleekMap.prototype.addGeolocationMarker = function (position, radius) {
		this.geolocationMarker = new google.maps.Marker({
			map: this.map,
			position: position,
			icon: {
				path: google.maps.SymbolPath.CIRCLE,
				scale: 5,
				fillColor: '#1758ce',
				fillOpacity: 1,
				strokeColor: '#1758ce',
				strokeOpacity: 1,
				strokeWeight: 0
			}
		});
		this.geolocationAccuracy = new google.maps.Circle({
			map: this.map,
			strokeColor: '#1758ce',
			strokeOpacity: 1,
			strokeWeight: 1,
			fillColor: '#1758ce',
			fillOpacity: 0.35,
			center: position,
			radius: radius
		});
	};

	// Update marker and accuracy circle
	SleekMap.prototype.updateGeolocationMarker = function (position, radius) {
		this.geolocationMarker.setPosition(position);
		this.geolocationAccuracy.setCenter(position);
		this.geolocationAccuracy.setRadius(radius);
	};

	// Add markers
	SleekMap.prototype.addMarkers = function (markers) {
		var t = this;
		var defaultIconSize = 32;

		// Go through all the markers
		markers.forEach(function (marker) {
			var args = {
				map: t.map,
				position: {
					lat: marker.lat,
					lng: marker.lng
				}
			};

			// Check for custom icon
			if (marker.icon) {
				args.icon = {
					url: marker.icon.url
				};

				// Icon size is also specified
				if (marker.icon.size) {
					// As object
					if (typeof marker.icon.size === 'object') {
						args.icon.scaledSize = marker.icon.size;
					}
					// As single value
					else {
						args.icon.scaledSize = {
							width: marker.icon.size,
							height: marker.icon.size
						};
					}
				}
				// Default size
				else {
					args.icon.scaledSize = {
						width: defaultIconSize,
						height: defaultIconSize
					};
				}

				// Icon anchor also specified
				if (marker.icon.anchor) {
					// As object
					if (typeof marker.icon.anchor === 'object') {
						args.icon.anchor = marker.icon.anchor;
					}
					// As single value
					else {
						args.icon.anchor = {
							x: marker.icon.anchor,
							y: marker.icon.anchor
						};
					}
				}
				// Default anchor
				else {
					args.icon.anchor = {
						x: defaultIconSize / 2,
						y: defaultIconSize / 2
					};
				}
			}

			// Create marker
			var gMarker = new google.maps.Marker(args);

			// Custom properties
			if (marker.customProperties) {
				gMarker.customProperties = marker.customProperties;
			}

			// Info window
			if (marker.infoWindow) {
				gMarker.addListener('click', function () {
					t.infoWindow.setContent('<div class="google-map-info-window">' + marker.infoWindow + '</div>');
					t.infoWindow.open(t.map, gMarker);
				});
			}

			t.markers.push(gMarker);
			t.markerBounds.extend(gMarker.getPosition());
		});

		// Center on markers
		if (this.markers.length) {
			if (this.markers.length === 1) {
				this.map.setCenter(this.markers[0].getPosition());
			}
			else {
				this.map.fitBounds(this.markerBounds);
			}
		}

		// Center on markers on map type change
		google.maps.event.addListener(this.map, 'maptypeid_changed', function () {
			if (t.markers.length === 1) {
				t.map.setCenter(t.markers[0].getPosition());
			}
			else {
				t.map.fitBounds(t.markerBounds);
			}
		});
	};

	// Add KML layers
	SleekMap.prototype.addKmlLayers = function (layers) {
		var t = this;

		// Add each layer
		layers.forEach(function (layer) {
			var kmlLayer = new google.maps.KmlLayer({
				map: t.map,
				url: layer.url
			});

			if (layer.customProperties) {
				kmlLayer.customProperties = layer.customProperties;
			}

			t.kmlLayers.push(kmlLayer);
		});

		// Center on KML files on map type change
		google.maps.event.addListener(this.map, 'maptypeid_changed', function () {
			t.map.fitBounds(t.kmlLayers[0].getDefaultViewport());
		});
	};

	//////////////////////////////////////////
	// Parse a map element for data-attributes
	SleekMap.parseMapEl = function (mapEl) {
		var config = {};

		// Zoom
		if (mapEl.dataset.zoom) {
			config.zoom = parseInt(mapEl.dataset.zoom);
		}

		// Center
		if (mapEl.dataset.lat && mapEl.dataset.lng) {
			config.center = {
				lat: parseFloat(mapEl.dataset.lat),
				lng: parseFloat(mapEl.dataset.lng)
			};
		}

		// Styles can be a string or JSON array
		if (mapEl.dataset.styles) {
			try {
				config.styles = JSON.parse(mapEl.dataset.styles);
			}
			catch (e) {
				// If styles is just a string - check if it's defined in SLEEK_CHILD_CONFIG.MAP_STYLES
				if (typeof SLEEK_CHILD_CONFIG !== 'undefined' && typeof SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES !== 'undefined' && typeof SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES[mapEl.dataset.styles] !== 'undefined') {
					config.styles = JSON.parse(SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES[mapEl.dataset.styles]);
				}
			}
		}

		// Types can be either string or JSON array
		if (mapEl.dataset.mapTypes) {
			try {
				config.mapTypes = JSON.parse(mapEl.dataset.mapTypes);

				// If map type styles is just a string - map it to the SLEEK_CHILD_CONFIG.MAP_STYLES
				for (var i = 0; i < config.mapTypes.length; i++) {
					if (typeof config.mapTypes[i].styles === 'string' && typeof SLEEK_CHILD_CONFIG !== 'undefined' && typeof SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES !== 'undefined' && typeof SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES[config.mapTypes[i].styles] !== 'undefined') {
						config.mapTypes[i].styles = JSON.parse(SLEEK_CHILD_CONFIG.GOOGLE_MAPS_STYLES[config.mapTypes[i].styles]);
					}
				}
			}
			catch (e) {
				config.mapTypes = [mapEl.dataset.mapTypes];
			}
		}

		// Geolocation can be either empty (indicating true) or JSON object
		if (typeof mapEl.dataset.geolocation !== 'undefined') {
			try {
				config.geolocation = JSON.parse(mapEl.dataset.geolocation);
			}
			catch (e) {
				config.geolocation = true;
			}
		}

		// KML Layers can be either string or JSON array
		if (mapEl.dataset.kmlLayers) {
			try {
				config.kmlLayers = JSON.parse(mapEl.dataset.kmlLayers);

				// If an array of URLs is passed in - convert to valid object
				for (var i = 0; i < config.kmlLayers.length; i++) {
					if (typeof config.kmlLayers[i] === 'string') {
						config.kmlLayers[i] = {
							url: config.kmlLayers[i]
						};
					}
				}
			}
			catch (e) {
				config.kmlLayers = [{
					url: mapEl.dataset.kmlLayers
				}];
			}
		}

		// Markers are stored as direct children of the mapEl
		if (mapEl.children.length) {
			var markers = [];

			for (var i = 0; i < mapEl.children.length; i++) {
				if (mapEl.children[i].dataset.lat && mapEl.children[i].dataset.lng) {
					var marker = {
						lat: parseFloat(mapEl.children[i].dataset.lat),
						lng: parseFloat(mapEl.children[i].dataset.lng)
					};

					// Icon can be string (src) or JSON object
					if (mapEl.children[i].dataset.icon) {
						try {
							marker.icon = JSON.parse(mapEl.children[i].dataset.icon);
						}
						catch (e) {
							marker.icon = {
								url: mapEl.children[i].dataset.icon
							};
						}
					}

					// Custom properties
					if (mapEl.children[i].dataset.customProperties) {
						try {
							marker.customProperties = JSON.parse(mapEl.children[i].dataset.customProperties);
						}
						catch (e) {
							marker.customProperties = mapEl.children[i].dataset.customProperties;
						}
					}

					// Info window?
					if (mapEl.children[i].innerHTML.length) {
						marker.infoWindow = mapEl.children[i].innerHTML;
					}

					markers.push(marker);
				}
			}

			if (markers.length) {
				config.markers = markers;
			}
		}

		return config;
	};

	module.exports = SleekMap;
})();
