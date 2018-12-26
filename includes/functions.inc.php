<?php

function resize_to_fit( $original_filename, 
                            $destination_folder,
                            $box_size,
                            $quality = 10 ){

    // load the original into the meory of the web server
    $original_image = load_web_image( $original_filename);

    if( !$original_image){
        die( 'resize_to_fit: Wrong Image Type.' );
    }

    // get the type and dimensions of the images
    $info = getimagesize( $original_filename );
    $original_width = $info[ 0 ];
    $original_height = $info[ 1 ];
    $type = $info ['mime'];


    // calculate the aspect ratio of the iamge
    $aspect = $original_width / $original_height;

    // calculate the dimensions of the resized image,
    // keeping the original proportions
    if ( $aspect > 1 ){
        //landscape image
        $new_width = $box_size;
        $new_height = ceil($new_width / $aspect);
    }else{
        //portrait or square
        $new_height = $box_size;
        $new_width = ceil($new_height * $aspect);
    }

    // create a new emput image in memory with the dimensions calculated in the last step
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // resample and copy pixels from the big image into the smaller image
    if( !imagecopyresampled( $new_image, $original_image, 
                        0, 0, 0, 0,
                        $new_width, $new_height,
                        $original_width, $original_height ) ){
        die( 'resize_to_fit: Could not copy and resample image.');
    }

    //remove the original file extension
    $filename_parts = explode( '.', $original_filename);
    array_pop ($filename_parts);
    $filename = implode('.', $filename_parts);

    // replace old folder with new folder
    $filename = str_replace( UPLOADS_FOLDER, $destination_folder, $filename );

    // create a new and correct file extension
    $extension = mime_to_extension($type);

    $new_image_filename = $filename . $extension;

    // write the new iamge to the disk of the web server
    if(!write_web_image ($new_image, $new_image_filename, $quality) ){
        die( 'resize_to_fit: Could not write image file.');
    }

    // free up the resources taken up by images in memory
    imagedestroy( $original_image );
    imagedestroy( $new_image );

    // return the file path of the new image
    return $new_image_filename;
}

function mime_to_extension( $type ){
    switch( $type ){
        case 'image/jpeg':
        return '.jpg';
            break;
        case 'image/pjpeg':
        return '.jpg';
            break;
        case 'image/png':
        return '.png';
            break;
        case 'image/gif':
        return '.gif';
        break;
    }
    return false;
}

function write_web_image( $image, $filename, $quality ){

    $filename_parts = explode( '.', $filename );
    $extension = strtolower(array_pop( $filename_parts ) );

    switch( $extension ){
        case 'jpg':
        case 'jpeg':
            $result = imagejpeg( $image, $filename, $quality * 10);
        break;
        case 'png':
            // takes our 0 to 10 quality value and converts it to a 9 to 0 compression value
            $compression = ( (10 - $quality) / 10) * 9;

            $result = imagepng( $image, $filename, $compression );
        break;
        case 'gif':
            $result = imagegif( $image, $filename );
        break;
        default:
            $result = false;
        break;
    }
        return $result;
}

function load_web_image( $filename ){
    $info = getimagesize( $filename );
    $type = $info[ 'mime' ];

    switch( $type ){
        case 'image/jpeg':
        case 'image/pjpeg':
            $image = imagecreatefromjpeg( $filename );

        break;
        case 'image/png':
            $image = imagecreatefrompng( $filename );

        break;
        case 'image/gif':
            $image = imagecreatefromgif( $filename );
        break;
        default:
            $image = false;
        break;
    }
    return $image;
}

function executeQuery($query){
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ) 
    or die( mysqli_connect_error() );

    $result = mysqli_query( $db, $query ) 
    or die( mysqli_error( $db ) );

    return $result;
}

    /**
    * Sends the user to the sign-in page if they are not signed in.
    */
    function secure_page(){
        if( !check_login() ){
            redirect( '/admin/sign-in.php');
        }
    }

    /**
    * Determines if the current user has been logged in.
    *
    * @return boolean - the user's log in status.
    *
    */
    function check_login(){
        return strcmp($_SESSION[ 'logged_in' ], LOGIN_TOKEN) == 0;
    }


/**
* Converts a URL friendly string back to the orginial title
*
* @param string $url - The URL to convert back into a title
* @return string - The title generated from the URL.
* 
**/
    function url_to_name( $url ){
        // decode the special characters
        $title = urldecode ($url);
        // replace spaces with dashes
        $title = str_replace( '-', ' ', $title);
        // restore title case
        $title = ucwords( $title );    
            
        return $title;
    }



/**
* Converts a title to a URL-friendly slug
*
* @param string $title - the title convert into a URL
* @return string - The URL-safe encoded title.
* 
**/
    function name_to_url( $title ){
        // lowercase the title
        $url = strtolower( $title );
        // replace spaces with dashes
        $url = str_replace( ' ', '-', $url);
        // encode any special characters 
        $url = urlencode ( $url );
        
        return $url;
        
    }

    /**
    *  Redirects the browser to the given URL, or refreshes the page with success added to the URL variables.
    *
    *  @param string $url - the optional URL to redirect the browser
    **/

    function redirect( $url = null ){
        
        if( !$url ){
            $url = $_SERVER[ 'PHP_SELF' ]. '?success';
        }
        
        header( 'Location: ' . $url );
        exit( "Redirect Failed. Go to <a href=\"$url\">link manually.</a>" ); // stop PHP if redirect failed.
    }




 /**
 * Removes potentially harmful content and makes it safe to insert into a database
 *
 * @param resource $db - The database connection resource.
 * @param string $text - The content to sanitize
 * @param boolean $allow_html Optionally allow HTML tags through, as listed      
 * in the ALLOWABLE_HTML_TAGS configuration setting.
 * @return string - Sanitezed version of the content text
 */
    function sanitize( $db, $text, $allow_html = false){
       // 1. remove whitespace at the beginning and end
        $text = trim( $text );
        // 2. remove some or all of the HTML tags
        if( $allow_html ){
            $text = strip_tags( $text, ALLOWABLE_HTML_TAGS );
        } else{
            $text = strip_tags( $text );
        }
        // 3. escape any characters that could break a MySQL query
        $text = mysqli_real_escape_string( $db, $text );
        
        // send the value of $text out of the function
        return $text;
    }
/**
* Wraps a message witht the markup needed for an error message
*
* @param string $message - The error message text to display
*
* @return string - The error message with markup added.
**/
    function error( $message ){
        
        return "<p class=\"error\">$message</p>";
    }
/**
* Outputs the provided message, but only if 'success' exists as a URL variable
*
* @param string $message - The message to display when the success condition is true.
* @return void
**/
    function success( $message ){
        if( isset( $_GET [ 'success'] ) ){
            echo "<p class=\"success\">$message</p>";
        }
    }