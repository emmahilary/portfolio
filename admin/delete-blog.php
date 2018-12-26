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

    // query for deleting the content
    if( isset( $_GET[ 'delete-id' ] ) 
        and ( is_numeric( $_GET[ 'delete-id' ] ) ) ){
        
        $delete_id = intval(sanitize ($db, $_GET[ 'delete-id' ] ));
        
        $query =    "DELETE FROM blog
                     WHERE blog_id = $delete_id";

        $result = mysqli_query( $db, $query )
        or die ( mysqli_error ($db) );
        
        redirect();
    }


$query =    "SELECT blog_id, blog_date, blog_title, blog_excerpt
            FROM blog
            ORDER BY blog_date ASC";

$result = mysqli_query( $db, $query )
        or die ( mysqli_error ($db) );

?>

<?php include('../includes/templates/admin/page-top.tpl.php'); ?>
        <main>
           <h2>Delete Blog Post</h2>
           <?php success( 'The post was successfully deleted.'); ?>
        <form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="get">
            <ol class="content-select">
               <?php while( $row = mysqli_fetch_assoc( $result ) ): ?>
                <li>
                    <input type="radio" name="delete-id" value="<?php echo $row['blog_id']; ?>" />
                    <label> <?php echo $row['blog_date']; ?>, <?php echo $row['blog_title']; ?></label> 
                </li>
                <?php endwhile; ?>
                <li><input type="submit" value="DELETE"/></li>
            </ol>
        </form>
        


        </main>
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>