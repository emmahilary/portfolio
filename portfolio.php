        
<?php

/**
* Blog Page
**/

    // load configuration settings
    require('includes/config.inc.php');

    // load helper functions
    require('includes/functions.inc.php');

    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die ( mysqli_connect_error() );
    
    // create a 'SELECT' query, to retrieve blog posts
    $query = "SELECT * FROM portfolio
                ORDER BY created_date DESC";

    // send query to database server, and store the result set
    // note: result set is in the web serve's memory,  $result
    // only keeps track of where in the memory the results are
    $result = mysqli_query( $db, $query )
        or die( mysqli_error ($db) );

    // set the page title, to be used in the templates
    $page_title = 'Portfolio';
        
?>
   <?php include('includes/templates/page-top.tpl.php'); ?>
   
    <main>
    <div class="page-header">
    <h1>PORTFOLIO</h1>
    <h5>find my recent work here</h5>
    </div>
         
        <article class="blog-posts">
        
        <div id="portfolio-posts">
        
        <?php    
            while( $row = mysqli_fetch_assoc( $result ) ): 

                // load the thumbnail template
                require('includes/templates/thumb-post.tpl.php' ); 
            
            endwhile; ?>
            
        </div>
        </article>
        </main>
<?php include('includes/templates/page-bottom.tpl.php'); ?>