
<?php

// load configuration settings
    require('includes/config.inc.php');

    // load helper functions
    require('includes/functions.inc.php');

    error_reporting( E_ALL & ~E_NOTICE );

$page_title = 'Contact Emma';

        $errors = array();
    // check if the user has hit the submit button yet
    if( isset( $_POST[ 'email' ] ) ){
        
        // form validation
        
        if( !filter_var( $_POST[ 'email' ], FILTER_VALIDATE_EMAIL ) ){
            // the email was not valid
            $errors[ 'email' ] 
                =  '<p class="error">
                        Please enter a valid email address.
                    </p>';
        }
        
        if( strlen( $_POST[ 'message' ] ) < 2 ){
            // the message was shorter than two characters
            // so let's trigger an error message
            $errors[ 'message' ] 
                =  '<p class="error">
                        Please enter a message.
                    </p>';
        }
        
        // if there were no error messages, it is ok
        // to try to send the email
        if( count( $errors ) == 0 ){
            
            $message = $_POST[ 'message' ];
            $name = $_POST[ 'name' ];
            $from_address = $_POST[ 'email' ];
            $to_address = 'emmahilarydesign@gmail.com';
            
            $message = '<h3>Message:</h3>' . $message;
            $message .= '<h3>From:</h3>' . $name;
            $message .= '<h3>Email:</h3>' . $from_address;
            
            require( 'includes/libraries/PHPMailer/src/PHPMailer.php' );
            
            $mail = new \PHPMailer\PHPMailer\PHPMailer;
            
            // who the email is coming from
            $mail->setFrom( $from_address, $name );
            // destination email address
            $mail->addAddress( $to_address, 'Emma' );
            // subject line
            $mail->Subject = 'Contact Form Email';
            // switch to HTML email mode
            $mail->isHTML( true );
            // set the message body
            $mail->Body = nl2br( $message );
            // set the plain text version of the body
            $mail->AltBody = strip_tags( $message );

            // attempt to send the email
            if( $mail->send() ){
                // email sent successfully - display success message
                
                // redirect to the same page we are on,
                // so that the POST data is eliminated
                // see: https://en.wikipedia.org/wiki/Post/Redirect/Get
                header( 'Location: ' 
                         . $_SERVER[ 'PHP_SELF' ] 
                         . '?success' );
            } else {
                // email fails to send - display error message
                $errors[ 'server' ]
                    = '<p class="error">
                        There was a server problem sending the email.
                        Please email hello@emmahilary.com if the problem continues.
                       </p>';
            }
        }
    }

?>
<?php include('includes/templates/page-top.tpl.php'); ?>
<main>

    <div class="page-header">
    <h1>CONTACT</h1>
    <h5>Let's work together!</h5>
    </div>

    <h4 class="contact-hello"><span class="stand-out">Oh hello there!</span></h4>
        
        <p class="contact-p"> <br>I said it first so you don't have to. Now that we've been introduced, don't be shy, drop me a line below. Project big or small - I am confident we can find a way to work together. From logo design to web development, WordPress to Shopify, photography to copy writing and everything in between, let's find a solution together.</p>
    
        <p class="contact-p">Use the form below to get in touch, or email hello@emmahilary.com</p>
    
    
<form class="client-form" method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>#contact" >
                <ol>
                <li class="name-box">
                <label>Name</label>
                        <input  class="input"
                                type="text"
                                name="name"
                                size="70" 
                                value="<?php echo $_POST[ 'name' ]; ?>"/>
                </li>
                <li class="email-box">
                <label>Email</label>
                       <?php echo $errors[ 'email' ]; ?>
                        <input  class="input"
                                type="text"
                                name="email"
                                size="70" 
                                value="<?php echo $_POST[ 'email' ]; ?>"/>
                </li>
                <li class="message-box">
                <?php echo $errors[ 'message' ]; ?>
                <label>Details</label>
                    <textarea name="message" cols="30" rows="8"><?php echo $_POST[ 'message' ]; ?></textarea>
                </li>
                <li class="submit-button">
                            <input type="submit"
                            value="submit">
                 </li>
            </ol>
            </form>
    
            <section class="newsletter">
           <h4>SUBSCRIBE FOR <span class="stand-out">monthly</span> NEWSLETTERS</h4>  
                <div class="ml-form-embed"
                  data-account="1343738:o1f0a3m8d3"
                  data-form="1139276:s9j6g7">
                </div>
        </section>
</main>  
           <?php include('includes/templates/page-bottom.tpl.php'); ?>