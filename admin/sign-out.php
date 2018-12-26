<?php

    // load configuration settings
    require('../includes/config.inc.php');
    // load helper settings
    require('../includes/functions.inc.php');

    // delete all the session data
    $_SESSION[ 'logged_in' ] = null;
    $_SESSION[ 'user_id' ] = null;
    $_SESSION[ 'username' ] = null;

    // delete the keys from the session array as well
    unset($_SESSION[ 'logged_in' ] );
    unset($_SESSION[ 'user_id' ] );
    unset($_SESSION[ 'username' ] );

    // send user back to the home page
    redirect( '/' );