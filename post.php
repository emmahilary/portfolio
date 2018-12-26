<?php

/**
* Single Project Page
**/

// load configuration settings
require('includes/config.inc.php');

// load helper functions
require('includes/functions.inc.php');

// connect to the database
$db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
    or die ( mysqli_connect_error() );

$project_name = $_GET[ 'project_name' ];

if( !empty( $project_name ) ){
    $project_name = url_to_name( $project_name );

    $project_name = sanitize( $db, $project_name );

    $query =    "SELECT * FROM portfolio
                WHERE project_name = '$project_name'
                LIMIT 1";

    $result = mysqli_query( $db, $query )
    or die ( mysqli_error ($db) );
    // check that we got at least one row
    if(mysqli_num_rows( $result ) > 0 ){

    // retrieve content for this blog post
    $row = mysqli_fetch_assoc( $result );

    // set the page title for the title tag
    $page_title = $row[ 'project_name' ];

    // laod the appropriate template
    require( 'includes/templates/full-post.tpl.php');

?>

<?php
        // stop PHP since the page is loaded
        exit();
    }
}

// if you end up here, we need to go to a 404 page
redirect( '404.php' );








