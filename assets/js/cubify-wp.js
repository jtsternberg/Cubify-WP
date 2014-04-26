/*! Cubify WP - v0.1.0 - 2014-04-26
 * http://webdevstudios.com
 * Copyright (c) 2014; * Licensed GPLv2+ */
/*jslint browser: true */
/*global jQuery:false */

window.Cubify_WP = (function(window, document, $, undefined){
	'use strict';

	var app = { $ : {} };
	_$ = app.$;
	// cross-browser safe logger
	var log = function() {
		log.history = log.history || [];
		log.history.push( arguments );
		if ( window.console ) {
			console.log( Array.prototype.slice.call(arguments) );
		}
	};

	app.cacheSelectors = function() {
		_$.cubes = $('.cubify-wp');
	};

	app.init = function() {
		app.cacheSelectors();
		app.cubify();
	};

	app.cubify = function() {
		_$.cubes.each( function() {

		});
	};

	$(document).ready( app.init );

	return app;

})(window, document, jQuery);
