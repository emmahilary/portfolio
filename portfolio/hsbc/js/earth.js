(function(){

	
	console.log( 'JavaScript started.' );
	
	var renderer = null;
	var scene 	 = null;
	var camera   = null;
    var controls = null;
	
	const FOV 	 = 45;
	const NEAR	 = 1;
	const FAR	 = 2000;
	
	var aspectRatio = 1;
	
	var objects = {};
	var lights	= {};
    var textures = {
        earthDiffuse : {
            url : 'images/specular-earth-hsbc.png',
            texture : null}
    };
    
    var modelLoader = null;
    var currentModelURL = '';
    
    var frameCounter = 0;
    
    var mouse = new THREE.Vector2();
    var raycaster = new THREE.Raycaster();
	
	function init(){
		console.log( 'init()' );

       	// delete the 'enable JavaScript' message
		document.getElementById( 'no-js' ).remove();

        
        $.getJSON( 'http://emmahilary.com/hsbc/server.php', {}, start );
        // add animation
        
    }
    
    function start( response ){
        
        $('#loading').hide();
        
        console.log( response );
        
        var countryNames = [];
        // build out div structure for accordion
        for( countryID in response ){
            if( response[ countryID ].name && response[ countryID ].url ){var div = $(
                        '<h3 id="' + response[ countryID ].name.toLowerCase().split( ' ' ).join('') + '">' + response[ countryID ].name + '</h3><div>' 
                        + '<a href="https://' + response[ countryID ].url + '" target=_blank>' + response[ countryID ].url + '</a>'
                      +  '</div>');
            $( "#accordion" ).append( div );    
            countryNames.push( response[ countryID ].name );
                                                                          
            }
        }
        
        $( "#accordion" ).accordion({
            heightStyle: "content"
        });
        


		
		renderer = Detector.webgl 
			? new THREE.WebGLRenderer({ antialias : true, alpha: true }) 
		    : new THREE.CanvasRenderer();
		
		document.body.appendChild( renderer.domElement );
		
		resize();
		
		window.addEventListener( 'resize', resize );
		
		scene = new THREE.Scene();
		
		camera = new THREE.PerspectiveCamera( FOV, aspectRatio, NEAR, FAR );
		
		scene.add( camera );
		
//		scene.add( new THREE.GridHelper( 1000, 100, 0xaaaaaa, 0x666666 ) );
//		scene.add( new THREE.AxesHelper( 1000 ) );
		
		camera.position.set( 400, 500, 500 );
		camera.lookAt( 0, 0, 0 );
        
        controls = new THREE.OrbitControls( camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.75;
        controls.enableZoom = true;
		
		lights.ambientLight = new THREE.AmbientLight( 0xffffff, 0.5 );
		
		scene.add( lights.ambientLight );
		
		lights.directionalLight = new THREE.DirectionalLight( 0xffffff, 0.75 );
		
		scene.add( lights.directionalLight );
		
		lights.directionalLight.position.set( 0, 0.25 , 1 );
        
        loadTextures();
        
        //textures.earthDiffuse.texture.offset = new THREE.Vector2( 0.37, 0 );
        //textures.earthDiffuse.texture.wrapS = THREE.RepeatWrapping;
        
		objects.earth = {
			geometry : new THREE.SphereGeometry( 200, 100, 50 ),
			material: new THREE.MeshPhongMaterial({ shininess: 10,
                                                    map:
                                                    textures.earthDiffuse.texture})
		}
        
        
		objects.earth.mesh = new THREE.Mesh( objects.earth.geometry,
										     objects.earth.material );
		scene.add( objects.earth.mesh );
    
        
        
        

        
       

        
//        var geocoder = new google.maps.Geocoder();
//        geocoder.geocode( { address : countryNames[ 2 ] }, function( results, status ){
//            console.log( 'here' );
//            console.log( results[ 0 ].geometry.location.lat(), results[ 0 ].geometry.location.lng() );
//            
//            var lat = 34.0201613//results[ 0 ].geometry.location.lat();
//            var lon = -118.6919205// ( results[ 0 ].geometry.location.lng() );
//
//            var cosLat = Math.cos(lat * Math.PI / 90.0);
//            var sinLat = Math.sin(lat * Math.PI / 90.0);
//            var cosLon = Math.cos(lon * Math.PI / 90.0);
//            var sinLon = Math.sin(lon * Math.PI / 90.0);
//
//            var x = 200 * cosLat * cosLon;
//            var y = 200 * cosLat * sinLon;
//            var z = 200 * sinLat;
//
//             objects.test = {
//			     geometry : new THREE.SphereGeometry( 10, 10, 10 ),
//			     material: new THREE.MeshPhongMaterial({ shininess: 10,
//                                                    color: 0xff0000})
//		      }
//        
//        
//		      objects.test.mesh = new THREE.Mesh( objects.test.geometry,
//										     objects.test.material );
//		      scene.add( objects.test.mesh );
//            
//            
//                objects.test.mesh.position.set( x, y, z );
//            
//        });
        
        
 
		update();
        
        renderer.domElement.addEventListener( 'click', mouseClicked );
	}
    // Creating a click function
    function mouseClicked( e ){
        console.log( e );
        
        mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
        mouse.y = - (e.clientY / window.innerHeight) * 2 + 1 ;
        
        raycaster.setFromCamera( mouse, camera );
        
        
        
        var intersectEarth = 
            raycaster.intersectObject( objects.earth.mesh );
        
        if( intersectEarth.length > 0 ){
            console.log( 'You clicked on the earth' );
        
            var clickX = intersectEarth[ 0 ].uv.x;
            var clickY = 1 - intersectEarth[ 0 ].uv.y;
            
            var textureWidth    = textures.earthDiffuse.texture.image.width;
            var textureHeight   = textures.earthDiffuse.texture.image.height;
            
            var realX = clickX * textureWidth;
            var realY = clickY * textureHeight;
            
            var locations = {
                'hongkong' : {
                    x1 : 6700,
                    x2 : 6450,
                    y1 : 1400,
                    y2 : 1600
                },
                'macausar' : {
                    x1 : 6700,
                    x2 : 6450,
                    y1 : 1400,
                    y2 : 1600
                },
                'india' : {
                    x1 : 6000,
                    x2 : 5730,
                    y1 : 1400,
                    y2 : 1800
                },
                'philippines' : {
                    x1 : 7000,
                    x2 : 6760,
                    y1 : 1580,
                    y2 : 1900
                },
                'taiwan' : {
                    x1 : 6900,
                    x2 : 6776,
                    y1 : 1470,
                    y2 : 1570
                },
                'newzealand' : {
                    x1 : 8180,
                    x2 : 7150,
                    y1 : 2790,
                    y2 : 3140
                },
                'turkey' : {
                    x1 : 5050,
                    x2 : 4700,
                    y1 : 1050,
                    y2 : 1250
                },
                'italy' : {
                    x1 : 4500,
                    x2 : 4300,
                    y1 : 1000,
                    y2 : 1200
                },
                'bermuda' : {
                    x1 : 2900,
                    x2 : 2550,
                    y1 : 1300,
                    y2 : 1480
                },
                'egypt' : {
                    x1 : 4800,
                    x2 : 4500,
                    y1 : 1300,
                    y2 : 1500
                },
                'oman' : {
                    x1 : 5500,
                    x2 : 5200,
                    y1 : 1500,
                    y2 : 1700
                },
                'korea' : {
                    x1 : 7100,
                    x2 : 6900,
                    y1 : 1100,
                    y2 : 1300
                },
                'bangladesh' : {
                    x1 : 6300,
                    x2 : 6000,
                    y1 : 1400,
                    y2 : 1600
                },
                'russia' : {
                    x1 : 7400,
                    x2 : 5000,
                    y1 : 400,
                    y2 : 800
                },
                'ireland' : {
                    x1 : 651,
                    x2 : 404,
                    y1 : 1498,
                    y2 : 1000
                },
                'malta' : {
                    x1 : 4500,
                    x2 : 4400,
                    y1 : 1200,
                    y2 : 1300
                },
                'luxembourg' : {
                    x1 : 4350,
                    x2 : 4250,
                    y1 : 950,
                    y2 : 1000
                },
                'uae' : {
                    x1 : 5550,
                    x2 : 5150,
                    y1 : 1498,
                    y2 : 1550
                },
                'southafrica' : {
                    x1 : 4850,
                    x2 : 4400,
                    y1 : 2600,
                    y2 : 2850
                },
                'armenia' : {
                    x1 : 5250,
                    x2 : 5100,
                    y1 : 1100,
                    y2 : 1250
                },
                'southafrica' : {
                    x1 : 4850,
                    x2 : 4400,
                    y1 : 2600,
                    y2 : 2850
                },
                'greece' : {
                    x1 : 4650,
                    x2 : 4500,
                    y1 : 1100,
                    y2 : 1280
                },
                'japan' : {
                    x1 : 7300,
                    x2 : 7125,
                    y1 : 1090,
                    y2 : 1300
                },
                'thailand' : {
                    x1 : 6550,
                    x2 : 6325,
                    y1 : 1570,
                    y2 : 1830
                },
                'usa' : {
                    x1 : 2220,
                    x2 : 1289,
                    y1 : 1090,
                    y2 : 1359
                },
                'malaysia' : {
                    x1 : 6490,
                    x2 : 6327,
                    y1 : 1880,
                    y2 : 2088
                },
                'saudiarabia' : {
                    x1 : 5260,
                    x2 : 4950,
                    y1 : 1380,
                    y2 : 1591
                },
                'germany' : {
                    x1 : 4477,
                    x2 : 4232,
                    y1 : 880,
                    y2 : 975
                },
                'spain' : {
                    x1 : 4060,
                    x2 : 3920,
                    y1 : 1070,
                    y2 : 1190
                },
                'argentina' : {
                    x1 : 2861,
                    x2 : 2673,
                    y1 : 2622,
                    y2 : 3138
                },
                'australia' : {
                    x1 : 7509,
                    x2 : 6730,
                    y1 : 2430,
                    y2 : 2893
                },
                'china' : {
                    x1 : 6860,
                    x2 : 6210,
                    y1 : 1050,
                    y2 : 1390
                },
                'france' : {
                    x1 : 4239,
                    x2 : 4000,
                    y1 : 960,
                    y2 : 1050
                },
                'uk' : {
                    x1 : 4080,
                    x2 : 3824,
                    y1 : 673,
                    y2 : 890
                },
                'vietnam' : {
                    x1 : 6580,
                    x2 : 6500,
                    y1 : 1641,
                    y2 : 1805
                },
                'chile' : {
                    x1 : 2520,
                    x2 : 2350,
                    y1 : 2600,
                    y2 : 3270
                },
                'indonesia' : {
                    x1 : 7000,
                    x2 : 6400,
                    y1 : 2340,
                    y2 : 2295
                },
                'mexico' : {
                    x1 : 2550,
                    x2 : 1550,
                    y1 : 1409,
                    y2 : 1725
                },
                'canada' : {
                    x1 : 2767,
                    x2 : 1050,
                    y1 : 616,
                    y2 : 1050
                }
            }
            
            for( country in locations ){
                if( ( realY < locations[country].y2 ) && ( realY > locations[country].y1 ) &&
                ( realX < locations[country].x1 ) && ( realX > locations[country].x2 )){
               console.log( country );
                
                document.getElementById( country ).click();

                }
            }
            
            
        }
        

    }
    
    
    function modelLoadComplete( geometry, materials ){
        console.log( geometry, materials );
        
        objects[ currentModelURL ] = {
            geometry: geometry,
            material: new THREE.MeshFaceMaterial( materials )
        };
        objects[ currentModelURL ].mesh = 
            new THREE.Mesh( objects[ currentModelURL ].geometry,
                            objects[ currentModelURL ].material );
        
        scene.add( objects[ currentModelURL ].mesh );
        
    }
    
    function loadTextures(){
        
        for( var textureName in textures ){
        textures[ textureName ].texture 
            = new THREE.TextureLoader().load( textures[ textureName ].url);
            }
    }
	
	function update(){
		
        frameCounter++;
        
		objects.earth.mesh.rotation.y += (Math.PI * 2) / 1350;
     
		renderer.render( scene, camera );
		requestAnimationFrame( update );
	}
	
	function resize(){
		
		var width 	= window.innerWidth;
		var height 	= window.innerHeight;
		
		aspectRatio = width / height;
		
		renderer.setSize( width, height );
		
		if( camera ){
			// make the camera match the proportions
			// of the window, so that the scene doesn't
			// look distorted
			camera.aspect = aspectRatio;
			camera.updateProjectionMatrix();
		}
	}
	
	window.addEventListener( 'load', init );
})();




















