<?php

    // load configuration settings
    require('../includes/config.inc.php');
    // load helper settings
    require('../includes/functions.inc.php');
    // reject unauthenticated users
    secure_page();


    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die ( mysqli_connect_error() );

    // query for loading the selected content
    if( isset( $_GET[ 'edit-id' ] ) 
        and ( is_numeric( $_GET[ 'edit-id' ] ) ) ){

        $edit_id = intval( sanitize( $db, $_GET[ 'edit-id' ] ) );
        
        $query =    "SELECT * FROM blog WHERE blog_id = $edit_id";
        
        $result = mysqli_query( $db, $query )
                        or die ( mysqli_error ($db) );
        
        $_POST = mysqli_fetch_assoc( $result );
    }

    // query for saving the editted the selected content
    if ( isset( $_POST[ 'edit-id' ] )
        and ( is_numeric( $_POST['edit-id'] ) ) ){
        // validate the content
        $edit_id = intval( sanitize($db, $_POST[ 'edit-id'] ) );
                // check if the title is missing
                if( empty ( trim($_POST['blog_title']) ) ){
                    $errors[ 'blog_title' ] = error('Please enter a blog title.');}
                // check if the content is missing
                if( empty ( trim($_POST['blog_content']) ) ){
                    $errors[ 'blog_content' ] = error('Please enter some content');}
                if( empty ( trim($_POST['blog_excerpt']) ) ){
                    $errors[ 'blog_excerpt' ] = error('Please enter an excerpt.');}
    
        // check if any validation errors occurred
        if( count( $errors ) == 0 ){
            // if not - sanitize the content
            $blog_title = sanitize ($db, $_POST[ 'blog_title' ] );
            $blog_content = sanitize($db, $_POST[ 'blog_content' ], true );
            $blog_excerpt = sanitize($db, $_POST[ 'blog_excerpt' ], true );

            // create an update query
                $query = "UPDATE blog
                            SET blog_title='$blog_title',
                                blog_content='$blog_content',
                                blog_excerpt='$blog_excerpt'
                                WHERE blog_id = $edit_id";
            // execute the query
            $result =   mysqli_query( $db, $query )
                        or die ( mysqli_error ($db) );
            // success message and redirect
            redirect();
            
        }
        }

            // query for listing all the possible content
            $query =    "SELECT blog_id, blog_title, blog_content, blog_excerpt
                        FROM blog
                        ORDER BY blog_title ASC";

            $result = mysqli_query( $db, $query )
                    or die ( mysqli_error ($db) );

?>

<?php include('../includes/templates/admin/page-top.tpl.php'); ?>
        <main>
           <h2>Edit A Blog Post</h2>
            <?php success( 'The post was successfully editted.'); ?>
           
            <?php if( !$edit_id ): ?>
           
        <form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="get">
            <ol class="content-select">
               <?php while( $row = mysqli_fetch_assoc( $result ) ): ?>
                <li>
                    <input type="radio" name="edit-id" value="<?php echo $row['blog_id']; ?>" />
                    <label title="Project Name"> <?php echo $row['blog_title']; ?> ?></label>
                </li>
                <?php endwhile; ?>
                <li><input type="submit" value="EDIT"/></li>
            </ol>
        </form>
        
            <?php else: ?>        
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <!-- this input is hidden from the user but submits the value of the id for the blog post being edited -->
            <input type="hidden" name="edit-id" value="<?php echo $edit_id; ?>" />
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
                                 size="80"
                                 maxlength="255">
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
                   <li><input type="submit" value="SAVE"/> </li>
               </ol>
           </form>
           
            <?php endif;?>
        
        </main>
        
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>