<?php

    // load configuration settings
    require('../includes/config.inc.php');
    // load helper settings
    require('../includes/functions.inc.php');

    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die ( mysqli_connect_error() );
?>
<?php include('../includes/templates/page-top.tpl.php'); ?>
        <main id="user">
           <h2>User Dashboard</h2>
           <?php if(!check_login() ): ?>
                <p>Please Log In To View This Page</p>
                <a class="user-button" href="/admin/sign-in.php">GO TO SIGN IN PAGE</a>
            <?php else : ?>
                <p>Welcome! This is the admin dashboard. Here's what you can do here.</p>
            <h5>Portfolio Submissions</h5>
                <p><a href="submit-post.php">Submit Post</a></p>
                <p><a href="edit-post.php">Edit Post</a></p>
                <p><a href="delete-post.php">Delete Post</a></p>
            <h5>Blog Submissions</h5>
                <p><a href="submit-blog.php">Submit Blog</a></p>
                <p><a href="edit-blog.php">Edit Blog</a></p>
                <p><a href="delete-blog.php">Delete Blog</a></p>
                
            <?php endif; ?>
        </main>
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>