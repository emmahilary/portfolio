<?php

/**
* PHP GENERAL SETTINGS
**/

// start the PHP Browser Session
// note: nothing can output before this function
session_start();

// show all errors but not notices
error_reporting( E_ALL & ~E_NOTICE );

// show errors in the browser
ini_set( 'display_errors', true );

// timezone
date_default_timezone_set( 'America/Toronto' );

/**
* DATABASE CREDENTIALS ( change these to your own )
**/

define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'implesto_main' );
define( 'DB_PASSWORD', 'Darcy' );
define( 'DB_NAME', 'implesto_emmahilary' );

/**
* SITE SETTINGS
**/

// title of the website / app
define( 'SITE_TITLE_HTML', 'EMMA HILARY DESIGN');

// title of the site
define( 'SITE_TITLE', 'Toronto Creative Designer - Emma Hilary Design');


// the root foler of the website as a URL
define( 'SITE_ROOT', 'https://emmahilary.com/');

// HTML tags allowed into blog content
define ( 'ALLOWABLE_HTML_TAGS', '<h2><h3><a><img><p><ul><ol><li><blockquote>');


/**
* Login Settings
*/
// enable or disable user registration
define( 'REGISTRATION_ALLOWED', true);

define( 'MIN_PASSWORD_LENGTH', 6);

// a specific string that marks a user as having logged in
define( 'LOGIN_TOKEN', 'sdkfjhweifhsdfhui345s32d');


// folder where all uploads will be stored
define( 'UPLOADS_FOLDER', '../uploads/' );

// folders for resized versions of the iamges uploaded
define('UPLOADS_THUMBNAIL', UPLOADS_FOLDER . 'thumbnail/');
define('UPLOADS_FULL', UPLOADS_FOLDER . 'full/');

// file types that are allowed to be uploaded
define( 'ALLOWED_FILE_TYPES', 'image/png,image/gif,image/jpeg,image/pjpeg' );