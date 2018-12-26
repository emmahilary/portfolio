$(function(){
	
	console.log( 'JavaScript started.' );
    
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    
    
    function photographybox(){
        console.log('You clicked on photo');
            
        $('#photography-box').toggleClass( 'open' );
        
        
    }

    $( '.camera-graphic' ).on( 'click', photographybox );

    
    
    
    function webbox(){
        console.log('You clicked on web');
            
        $('#web-box').toggleClass( 'open' );
        
    }

    $( '.laptop-graphic' ).on( 'click', webbox );
    
    
    
    
    function notebookbox(){
        console.log('You clicked on notebook');
            
        $('#notebook-box').toggleClass( 'open' );
        
    }

    $( '.notebook-graphic' ).on( 'click', notebookbox );
    

    //CLOSE BOXES
    $(".closePhoto").click(function() {
        $('#photography-box').removeClass('open');
        return false;
    });
    $(".closeWeb").click(function() {
        $('#web-box').removeClass('open');
        return false;
    });
    $(".closeNote").click(function() {
        $('#notebook-box').removeClass('open');
        return false;
    });
    
    
    function onScroll(){
        console.log( $(window).scrollTop(), $('.large-graphics').offset().top );
        if( $(window).scrollTop() >= $('.large-graphics').offset().top ){
           setTimeout( showPopup, 800 );
        }
    }
    
    function showPopup(){
        console.log( 'showing popup' );
        $( ".click-popup" ).fadeIn();
        setTimeout( removePopup, 10000 );
        
    }
    
    function removePopup(){
        console.log( 'remove popup' );
        $( ".click-popup" ).fadeOut();
    }
    
    $( window ).on( 'scroll', onScroll )
    
      $( function() {
    $( "#tabs" ).tabs();
  } );

});



