        
<?php

/**
* Blog Page
**/

    // load configuration settings
   require('includes/config.inc.php');

    // load helper functions
   require('includes/functions.inc.php');

    // connect to the database
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
        or die ( mysqli_connect_error() );
    
    // create a 'SELECT' query, to retrieve blog posts
    $query = "SELECT * FROM blog
                ORDER BY blog_id DESC
                LIMIT 3";

    // send query to database server, and store the result set
    // note: result set is in the web serve's memory,  $result
    // only keeps track of where in the memory the results are
    $result = mysqli_query( $db, $query )
        or die( mysqli_error ($db) );
    // set the page title, to be used in the templates
    $page_title = 'Emma Hilary Design Home Page';
    
include('includes/templates/page-top.tpl.php');

?>
<!--


<!doctype html>
<html lang ="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <title>Web Designer - Emma Hilary Design</title>
        
        <link rel="stylesheet" href="css/style.css" />
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        
        <link rel="icon" href="/favicon.png" type="image/png">

       <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
       
    <script src="js/portfolio.js"></script>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>     
        [if lt IE 9]>
	       <script src="js/html5shiv.min.js"></script>
        <![endif]
    </head>
    <body>
      <header class="header">
          <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php"><img class="small-logo" src="../images/ehd-small.png" alt="small logo"></a>
          
          
          <div class="menu-bar"></div>
          
                <span onclick="openNav()" class="open-nav">&#9776;</span>
          
          <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php">HOME</a>
          <a href="/blog.php">BLOG</a>
          <a href="/portfolio.php">PORTFOLIO</a>
          <a href="/about.php">ABOUT</a>
          <a href="/contact.php">CONTACT</a>
        </div>

       </header>

        
        
-->
        
       <main class="home-page">
           <h1>EMMA HILARY DESIGN</h1>
        <section class="home-top">
          <!-- Large Graphics -->
           <div class="large-graphics">
               
                <img src="images/click-here.png" class="click-popup" alt="pop up">
               
                <img class="camera-graphic" src="images/camera.png" alt="camera" >
               
                <img class="laptop-graphic" src="images/laptop.png" alt="laptop">
               
                <img class="notebook-graphic" src="images/notebook4.png" alt="notebook">
               
           </div>
            <!-- Pop Up Boxes -->
        <div id="pop-ups">
         <div class="pop-up-box" id="photography-box">
          <a class="closePhoto" href="#">&times;</a>
          <h6>visuals</h6>
          <ol>
              <li>photography</li>
              <li>videography</li>
              <li>visual design</li>
              <li>post production</li>
            </ol>
          </div>  
          
          <div class="pop-up-box" id="web-box"> <a class="closeWeb" href="#">&times;</a>
          <h6>web</h6>
          <ol>
              <li>web design</li>
              <li>web development</li>
              <li>app development</li>
              <li>e-commerce</li>
            </ol>
          </div>  
          
          <div class="pop-up-box" id="notebook-box"> <a class="closeNote" href="#">&times;</a>
          <h6>content</h6>
          <ol>
              <li>blogging</li>
              <li>media management</li>
              <li>copy writing</li>
              <li>visual arts</li>
            </ol>
          </div>  
          </div>  
              
            <h3>
                HI THERE! MY NAME IS EMMA MCKAY<br> &amp; I’M A <span class="stand-out">creative designer</span> FROM TORONTO
            </h3>
        </section>
        <section class="home-intro">
           <p>
            Your business is ever changing, and <span class="stand-out">your designer needs to keep up!</span>
            </p>
            <p>
                First and foremost, I’m a passionate <span class="stand-out">web developer</span> specializing in custom web 
                solutions. Never one to stay in my lane, I am also a photographer, 
                videographer, graphic designer, blogger and artist. I support clients at all levels of their journey from ideas and <span class="stand-out">branding</span> to <span class="stand-out">logo design</span> and web development. I’m also available to provide top quality content to match like <span class="stand-out">video reels</span> and <span class="stand-out">photography</span> and SEO friendly and attention grabbing <span class="stand-out">written copy. </span>
            </p>
            <p>
            Whether you’re looking for help with a standalone project, or the-whole-shabang-all-inclusive experience - <span class="stand-out">if it’s on the web; I’m here to help.</span>
            </p>
           </section>
        <div class="home-skills">
            <a href="#"><h2 class="view-button">VIEW PORTFOLIO</h2></a>
           <section class="home-web">
            <div class="img-float">
           <img class="skills-img laptop-skills" src="images/laptop.png" alt="laptop"></div>
            <div class="p-float"> 
            <p>I design and develop beautiful, responsive websites and application that engage your customers and leave an impact. From designing to full stack development and ongoing support, I’m here to help you every step of the way. Whether you’re looking for something custom, tweaks to Shopify or WordPress or a fully unique e-commerce solution, let me make your design dreams a reality.</p>
            <p><span class="stand-out">web skillset:</span> HTML / CSS / PHP / mySQL / JAVASCRIPT / jQUERY / WORDPRESS / GIT / JSON / AJAX / SHOPIFY</p></div>   
           </section>
           <section class="home-visuals">
               <div class="img-float"><img class="skills-img camera-image" src="images/camera.png" alt="camera" ></div>
               <div class="p-float"> 
                   <p>I work in photography and videography, along with visual design and post production. I am passionate about capturing the right essence for your business, curating beautiful and memorable visual content, across different mediums. I specialize in lifestyle and travel branded content. </p>
                   <p><span class="stand-out">visual skillset:</span> PHOTOGRAPHY / VIDEOGRAPHY / PHOTOSHOP / ILLUSTRATOR / VISUAL DESIGN / POST PRODUCTION</p></div>
           </section>
           <section class="home-content">
           <div class="img-float"><img class="skills-img note-image" src="images/notebook5.png" alt="notebook"></div>
               <div class="p-float">
                   <p>Looking past a beautiful, functional website, content creation is the next step. From copy writing to affiliate sales and marketing, making your business a success is my top priority. Get great SEO optimized content, advice on monetization, ads and social media management.</p><p><span class="stand-out">content skillset:</span> BLOGGING / COPY WRITING / EDITING / SOCIAL MEDIA MANAGEMENT / BRAND MANAGEMENT / AFFILIATE SALES</p></div>
           </section>
            </div>
        <section class="home-blog">
           <h2>Check out my blog</h2>
            <h5>personal musings &amp; web tips and tricks</h5>
            <br><br>
            
            <?php    
            while( $row = mysqli_fetch_assoc( $result ) ): 

                // load the thumbnail template
                require('includes/templates/home-blog-thumb.tpl.php' ); 
            
            endwhile; ?>
            
        </section>
        <section class="newsletter">
           <h4>SUBSCRIBE FOR <span class="stand-out">monthly</span> NEWSLETTERS</h4>
                        <div class="ml-form-embed"
                  data-account="1343738:o1f0a3m8d3"
                  data-form="1139276:s9j6g7">
                </div>
        </section>
      </main> 
<!--
    <footer>
    <ul class="footer-menu">
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php">HOME</a></li>    
            <li><a href="/blog.php">BLOG</a></li>   
            <li><a href="/portfolio.php">PORTFOLIO</a></li>   
            <li><a href="/about.php">ABOUT</a></li>   
            <li><a href="/contact.php">CONTACT</a></li> 
    </ul>  
    <ul class="footer-socials">
        <li><a href="https://www.facebook.com/simplestofadventures/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="https://www.linkedin.com/in/emma-hilary/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="https://www.instagram.com/emmahilarydesign/" target="_blank"><i class="fab fa-instagram"></i></a></li>
    </ul>
    </footer>
    </body>
</html>-->

<?php include('includes/templates/page-bottom.tpl.php'); ?>
