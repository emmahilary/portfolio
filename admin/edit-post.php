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
        
        $query =    "SELECT * FROM portfolio WHERE id = $edit_id";
        
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
                if( empty ( trim($_POST['project_name']) ) ){
                    $errors[ 'project_name' ] = error('Please enter a Project Name.');}
                // check if the content is missing
                if( empty ( trim($_POST['category']) ) ){
                    $errors[ 'category' ] = error('Please chose a category.');}
                if( empty ( trim($_POST['content']) ) ){
                    $errors[ 'content' ] = error('Please enter some content.');}
                if( empty ( trim($_POST['skills']) ) ){
                    $errors[ 'skills' ] = error('Please enter what skills were used.');}
                if( empty ( trim($_POST['live_site']) ) ){
                    $errors[ 'live_site' ] = error('Please enter a link to the live site.');}
    
        // check if any validation errors occurred
        if( count( $errors ) == 0 ){
            // if not - sanitize the content
            $project_name = sanitize ($db, $_POST[ 'project_name' ] );
            $category = sanitize($db, $_POST[ 'category' ], true );
            $content = sanitize($db, $_POST[ 'content' ], true );
            $skills = sanitize($db, $_POST[ 'skills' ], true );
            $live_site = sanitize($db, $_POST[ 'live_site' ], true );
            // create an update query
                $query = "UPDATE portfolio 
                            SET project_name='$project_name',
                                category='$category',
                                content='$content',
                                skills='$skills',
                                live_site='$live_site'
                                WHERE id = $edit_id";
            // execute the query
            $result =   mysqli_query( $db, $query )
                        or die ( mysqli_error ($db) );
            // success message and redirect
            redirect();
            
        }
        }

            // query for listing all the possible content
            $query =    "SELECT id, project_name, category, content, skills, live_site
                        FROM portfolio
                        ORDER BY project_name ASC";

            $result = mysqli_query( $db, $query )
                    or die ( mysqli_error ($db) );

?>

<?php include('../includes/templates/admin/page-top.tpl.php'); ?>
        <main>
           <h2>Edit A Post</h2>
            <?php success( 'The post was successfully editted.'); ?>
           
            <?php if( !$edit_id ): ?>
           
        <form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="get">
            <ol class="content-select">
               <?php while( $row = mysqli_fetch_assoc( $result ) ): ?>
                <li>
                    <input type="radio" name="edit-id" value="<?php echo $row['id']; ?>" />
                    <label title="Project Name"> <?php echo $row['project_name']; ?> ?></label>
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
                       <label>Project Name</label>
                       <?php echo $errors[ 'project_name' ]; ?>
                       <input  type="text"
                               name="project_name"
                               value="<?php echo $_POST[ 'project_name']; ?>"
                               size="80"
                               maxlength="255">
                   </li>
                   <li>
                       <label>Category</label>
                       <?php echo $errors[ 'category' ]; ?>
                       <input type="text"
                                 name="category"
                                 value="<?php echo $_POST['category']; ?>"
                                 size="80"
                                 maxlength="255">
                   </li>
                   <li>
                       <label>Content</label>
                       <?php echo $errors[ 'content' ]; ?>
                       <textarea  class="editor"
                               name="content"
                               value="<?php echo $_POST[ 'content']; ?>"
                               rows="10"
                                 cols="80"><?php echo $_POST[ 'content']; ?></textarea>
                   </li>
                   <li>
                       <label>Skills</label>
                       <?php echo $errors[ 'skills' ]; ?>
                       <input  type="text"
                               name="skills"
                               value="<?php echo $_POST[ 'skills']; ?>"
                               size="80"
                               maxlength="255">
                   </li>
                   <li>
                       <label>Live Site Link</label>
                       <?php echo $errors[ 'live_site' ]; ?>
                       <input type="text"
                                 name="live_site"
                                 value="<?php echo $_POST['live_site']; ?>"
                                 size="80"
                                 maxlength="255">
                   </li>
                   <li><input type="submit" value="SAVE"/> </li>
               </ol>
           </form>
           
            <?php endif;?>
        
        </main>
        
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>