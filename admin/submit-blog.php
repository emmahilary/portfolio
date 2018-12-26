<?php   

    // load configuration settings
    require('../includes/config.inc.php');

    // load helper functions
    require('../includes/functions.inc.php');
    // reject unauthenticated users
    secure_page();


    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die ( mysqli_connect_error() );

    // an erray to store error messages
    $errors = array();

    // was the form submitted
    if( isset($_POST[ 'blog_title' ] ) ){

        // check if any content is missing
                if( empty ( trim($_POST['blog_title']) ) ){
                    $errors[ 'blog_title' ] = error('Please enter a blog title.');}
                // check if the content is missing
                if( empty ( trim($_POST['blog_content']) ) ){
                    $errors[ 'blog_content' ] = error('Please enter some content');}
                if( empty ( trim($_POST['blog_excerpt']) ) ){
                    $errors[ 'blog_excerpt' ] = error('Please enter an excerpt.');}
        
      $temp_path = $_FILES[ 'user-upload' ][ 'tmp_name' ];

    // extract original extension
    $info = getimagesize( $temp_path  );
    $type = $info[ 'mime' ];

    $extension = mime_to_extension( $type );

    // generate a unique filename
    $filename = str_replace( array( ' ', '!' ), array( '-', '' ), strtolower( trim( $_POST['blog_title'] ) ) );

    // put it all together into a folder path
    $destination_path = UPLOADS_FOLDER . "$filename$extension";

    // check if maximum file size is exceeded
    switch( $_FILES[ 'user-upload' ][ 'error' ] ){
        case UPLOAD_ERR_INI_SIZE:
            $errors[ 'server' ] = error( 'The uploaded file has exceeded the maximum allowed filesize of ' . ini_get( 'upload_max_filesize' ) );
        break;
        case UPLOAD_ERR_PARTIAL:
            $errors[ 'server' ] =  error( 'The file was only
            partially uploaded, please try again.' );
        break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $errors[ 'server' ] =  error('The file could not
            be uploaded as the temporary directory is missing; contact
            the administrator.');
        break;
        case UPLOAD_ERR_CANT_WRITE:
            $errors[ 'server' ] =  error('The file could not
            be uploaded as the server could not write the file to the drive; contact the administrator.');
        break;
        case UPLOAD_ERR_NO_FILE:
            $errors[ 'file' ] =  error('Please select a file to
            upload.');
        break;
        case UPLOAD_ERR_OK:
            // no errors reported from server

            // read the MIME type from the file
            $type = mime_content_type( $temp_path );

            // check if the file is one of the allowed file types
            if( strpos( ALLOWED_FILE_TYPES, $type ) === FALSE ){
                $errors[ 'file' ] =  error( 'The file uploaded
                is not one of the allowed types: png, jpg, gif.' );
            }

            // for images - check if file is corrupted or possibly contains
            // malicious code
            if( getimagesize( $temp_path ) === FALSE ){
                $errors[ 'file' ] =  error( 'The file uploaded
                is corrupted, please upload a different one.' );
            }

            if( count( $errors ) == 0 ){
                if( move_uploaded_file( $temp_path, $destination_path ) ){

                    $thumbnail = resize_to_fit( $destination_path, 
                                            UPLOADS_THUMBNAIL,
                                            300,
                                            10);

                    $full = resize_to_fit( $destination_path, 
                                            UPLOADS_FULL,
                                            500,
                                            10);

                } else {
                    $errors[ 'server' ] =  error( 'There was a server
                    issue saving your file, contact the administrator.' );
                }
            }
        break;
    }      
        
        // verify is there any errors generated
        if( count( $errors ) == 0 ){
            
            // sanitize the user input
            
            // escape any special characters and remove all HTML tags
                // remove HTML tags, except for those listed under allowable
            $blog_title = sanitize ($db, $_POST[ 'blog_title' ] );
            $blog_content = sanitize($db, $_POST[ 'blog_content' ], true );
            $blog_excerpt = sanitize($db, $_POST[ 'blog_excerpt' ], true );
            
            $blog_img = sanitize($db, "$filename$extension" );
            
            // escape any special characters and remove HTML tags EXCEPT those lised under 
            // ALLOWABLE_HTML_TAGS constant ( in config file ) 

            // build an INSERT query, using the santized data
            $query = "INSERT INTO blog( blog_title, blog_content, blog_excerpt, blog_img )
                      VALUES('$blog_title', '$blog_content', '$blog_excerpt', '$blog_img')";
            // excute the query on your MySQL server
            $result =   mysqli_query( $db, $query )
                        or die ( mysqli_error ($db) );
            // redirect the browser to refresh the page so that the form data is discarded and we can display an error message
            
            $_POST = array();
            
            header( "Location: {$_SERVER['PHP_SELF']}?success"  );
            
             }
    }

?>

<?php include('../includes/templates/admin/page-top.tpl.php'); ?>
        <main>
           <h2>Submit A Project</h2>
           <?php 
                success( 'Blog Post was successfully added to database.');
            ?>
           <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
               <ol>
                   <li>
                       <label>Blog Title</label>
                       <?php echo $errors[ 'blog_title' ]; ?>
                       <input  type="text"
                               name="blog_title"
                               value="<?php echo $_POST[ 'blog_title']; ?>"
                               size="80"
                               maxlength="255">
                   </li>
                   <li>
                       <label>Blog Excerpt</label>
                       <?php echo $errors[ 'blog_excerpt' ]; ?>
                       <input type="text"
                                 name="blog_excerpt"
                                 value="<?php echo $_POST['blog_excerpt']; ?>"
                                 size="80">
                   </li>
                   <li>
                       <label>Blog Content</label>
                       <?php echo $errors[ 'blog_content' ]; ?>
                       <textarea  class="editor"
                               name="blog_content"
                               value="<?php echo $_POST[ 'blog_content']; ?>"
                               rows="10"
                                 cols="80"><?php echo $_POST[ 'blog_content']; ?></textarea>
                   </li>
                   <li>
                   <label>Upload An Image</label>
                       <?php echo $errors[ 'blog_img' ]; ?>
                    <div class="file-input-wrapper">
                   <span></span>
                    <input type="file"
                       name="user-upload" 
                       size="80" />
                    </div>
           </li>
                   <li><input type="submit" value="SAVE"/> </li>
               </ol>
           </form>
        </main>
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>