/**
 * Cubify WP
 * http://webdevstudios.com
 *
 * Copyright (c) 2014 WebDevStudios
 * Licensed under the GPLv2+ license.
 */

window.Cubify_WP = (function(window, document, $, undefined){
	'use strict';

	// cross-browser safe logger
	var log = function() {
		log.history = log.history || [];
		log.history.push( arguments );
		if ( window.console ) {
			console.log( Array.prototype.slice.call(arguments) );
		}
	};

	// init our app object
	var app = { $ : {} };
	// shortcut to cached vars
	var _$ = app.$;

	app.cacheSelectors = function() {
		_$.cubes = $('.cubify-wp');
	};

	app.init = function() {
		app.cacheSelectors();
		app.cubify();
	};

	app.cubify = function() {
		_$.cubes.each( function() {
			new app.m3d( $(this) );
		});
	};

	$(document).ready( app.init );


	app.m3d = function( $cube ) {
		var m3d = { $cube : $cube };

		m3d.init = (function(){
			if ( true === m3d.initDone ){ return; }
			m3d.setupScene();

			m3d.addCube();
			m3d.addLights();
			m3d.update();
			m3d.initDone = true;
		})();

		m3d.setupScene = function() {
			m3d.scene = new THREE.Scene();
			m3d.camera = new THREE.PerspectiveCamera( 75, window.innerWidth /
				window.innerHeight, 0.1, 1000 );
			m3d.camera.position.set( 0, 0, 5 );
			m3d.renderer = new THREE.WebGLRenderer();
			m3d.renderer.setSize( window.innerWidth, window.innerHeight );
			m3d.$cube.append( m3d.renderer.domElement );
		};

		m3d.update = function() {
			m3d.cube.rotation.y += 0.01;
			m3d.cube.rotation.x += 0.01;

			requestAnimationFrame( m3d.update );
			m3d.renderer.render( m3d.scene, m3d.camera );
		};

		m3d.addCube = function() {
			var geometry = new THREE.CubeGeometry( 1, 1, 1 );

			var material = new THREE.MeshPhongMaterial( { color: 0xcccccc } );

			m3d.cube = new THREE.Mesh( geometry, material );
			m3d.scene.add( m3d.cube );
		};

		m3d.addLights = function() {
			m3d.directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
			m3d.directionalLight.position.set( 0.3, 1, 1 ).normalize();
			m3d.scene.add( m3d.directionalLight );

			m3d.ambientLight = new THREE.AmbientLight( 0x333333 );
			m3d.scene.add( m3d.ambientLight );
		};

		return m3d;
	};

	return app;

})(window, document, jQuery);
