<?php

    // load configuration settings
    require('../includes/config.inc.php');
    // load helper settings
    require('../includes/functions.inc.php');

    // if the user is already signed in, send them to the admin page
    if( check_login() ){
        redirect('/admin/' );
    }

    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die( mysqli_connect_error() );
    

    // an erray to store error messages
    $errors = array();

    // was the form submitted
    if( isset($_POST[ 'username' ] ) ){
        
        if(!filter_var( trim($_POST[ 'username' ]) ) ) {
            $errors [ 'username' ] = error ( 'Please enter a valid username.');
        }
        if(empty ( $_POST[ 'password' ] ) ){
            $errors [ 'password' ] = error ( 'Please enter a password.');
        }
        if( count($errors) == 0){
            
            // query the database looking for the entered email
            
            // sanitize the email
            $username = sanitize( $db, $_POST['username'] );
            
            //encrypt the password
            $password = sha1( $_POST['password'] );

            $query = "SELECT * FROM user
                        WHERE username = '$username'
                        LIMIT 1";
            
            $result = mysqli_query( $db, $query )
                or die( mysql_error($db)); 
            
            if(mysqli_num_rows( $result ) == 1 ){
                // the email matched
                $row = mysqli_fetch_assoc( $result );
                
                //compage passwords using PHP
                //NOTE: NEVER compare passwords using SQL
                
                if( strcmp( $username, $row[ 'username'] )  == 0){
                    if( strcmp( $password, $row['password']) == 0 ){
                        // login happens here
                    $_SESSION[ 'logged_in' ] = LOGIN_TOKEN;
                    $_SESSION[ 'username' ] = $row[ 'username' ];
                    
                    redirect( '/admin/' );
                    }
                
                }else{
                    $errors [ 'password' ] = error ( 'The password was incorrect');
                }
                
            }else{
                $errors [ 'username' ] = error ( 'The username entered is not registered on this site.');
            }
        }
        
    }// END BIG IF
?>
<?php include('../includes/templates/admin/page-top.tpl.php'); ?>
        <main>
           <h2>Sign In</h2>
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
               <ol>
                   <li>
                       <label>Username</label>
                       <?php echo $errors[ 'username' ]; ?>
                       <input  type="text"
                               name="username"
                               value="<?php echo $_POST[ 'username']; ?>"
                               size="80">
                   </li>
                   <li>
                       <label>Password</label>
                       <?php echo $errors[ 'password' ]; ?>
                       <input  type="password"
                               name="password"
                               size="80">
                   </li>
                   <li><input type="submit" value="Sign In"/> </li>
<!--
                    <li>
                        <a class="user-button" href="../index.html">Return Home</a>
                    </li>
-->
               </ol>
           </form>
        </main>
<?php include('../includes/templates/admin/page-bottom.tpl.php'); ?>








