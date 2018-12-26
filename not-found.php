        
<?php

/**
* Blog Page
**/

    // load configuration settings
    require('includes/config.inc.php');

    // load helper functions
    require('includes/functions.inc.php');


    // set the page title, to be used in the templates
    $page_title = 'Not Found';
//    
include('includes/templates/page-top.tpl.php');

?>


    <main>
    <div class="page-header">
    <h1>OOPS</h1>
    <h5>the page can't be found</h5>
    </div>
           
        <div class="404-page">
            
            <p>I'm sorry! The page cannot be found. The content you are looking for was either deleted, or moved somewhere new.</p>
            
            <p>Use one of the links below to get back to where you should be!</p>
            
        </div>
           
        
        <!-- INSERT NEWS LETTER -->
       </main>
        
<?php include('includes/templates/page-bottom.tpl.php'); ?>







