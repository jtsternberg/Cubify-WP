/*! Cubify WP - v0.1.0 - 2014-04-27
 * http://webdevstudios.com
 * Copyright (c) 2014; * Licensed GPLv2+ */
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
		var $cube, w;
		// Loop shortcode instances
		_$.cubes.each( function() {
			$cube = $(this);
			// get percentage attribute
			var percentage = $cube.data( 'percentage' );
			// calculate width
			w = Math.round( ( $cube.parent().width() * percentage ) / 100 );
			// Set cube width/height
			$cube.width( w );
			$cube.height( w );
			// Init threejs 3d object
			new app._3d( $cube, w );
		});
	};

	$(document).ready( app.init );

	app._3d = function( $cube, size ) {

		var _3d = {};

		_3d.loadDataAttributes = function() {
			var data = $cube.data();
			_3d.cubeMaterial = new THREE.MeshLambertMaterial( { color: 0xcccccc } );

			if ( data.img ) {
				_3d.cubeMaterial.map = THREE.ImageUtils.loadTexture( data.img );
			}

			if ( data.color ) {
				_3d.cubeMaterial.color = new THREE.Color( data.color );
			}

		};

		_3d.setupScene = function() {
			_3d.renderer = new THREE.WebGLRenderer( { alpha: true } );
			_3d.renderer.setSize( size, size );
			_3d.renderer.setClearColor( 0x000000, 0 );

			$cube.append( _3d.renderer.domElement );

			_3d.camera = new THREE.PerspectiveCamera( 45, size /
				size, 1, 1000 );
			_3d.camera.position.set( 0, 0, 5 );

			_3d.scene = new THREE.Scene();
		};

		_3d.update = function() {
			_3d.cube.rotation.y += 0.01;
			_3d.cube.rotation.x += 0.01;

			requestAnimationFrame( _3d.update );
			_3d.renderer.render( _3d.scene, _3d.camera );
		};

		_3d.addCube = function() {
			_3d.cube = new THREE.Mesh( new THREE.BoxGeometry( 2, 2, 2 ), _3d.cubeMaterial );
			_3d.scene.add( _3d.cube );
		};

		_3d.addLights = function() {
			_3d.ambientLight = new THREE.AmbientLight( 0x333333 );
			_3d.scene.add( _3d.ambientLight );

			_3d.directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
			_3d.directionalLight.position.set( 1, 1, 2 ).normalize();
			_3d.scene.add( _3d.directionalLight );
		};

		_3d.init = (function() {
			if ( true === _3d.initDone ){
				return;
			}
			_3d.setupScene();
			_3d.loadDataAttributes();

			_3d.addCube();
			_3d.addLights();
			_3d.update();
			_3d.initDone = true;
		})();

		return _3d;
	};

	return app;

})(window, document, jQuery);
