/**
 * Cubify WP
 * http://webdevstudios.com
 *
 * Copyright (c) 2014 WebDevStudios
 * Licensed under the GPLv2+ license.
 */

/*jslint browser: true */
/*global jQuery:false */

window.Cubify_WP = (function(window, document, $, undefined){
	'use strict';

	var app = {};
	// cross-browser safe logger
	var log = function() {
		log.history = log.history || [];
		log.history.push( arguments );
		if ( window.console ) {
			console.log( Array.prototype.slice.call(arguments) );
		}
	};

	app.init = function() {

	};

	$(document).ready( app.init );

	return app;

})(window, document, jQuery);
