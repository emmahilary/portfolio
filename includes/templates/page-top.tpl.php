<!doctype html>
<html lang ="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title><?php echo $page_title; ?> - <?php echo SITE_TITLE; ?></title>
        
        <link rel="stylesheet" href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/css/style.css" />
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        
        <link rel="icon" href="/favicon.png" type="image/png">
        
       <script
      src="https://code.jquery.com/jquery-1.12.4.min.js"
      integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
      crossorigin="anonymous"></script>
        
        <script src="../../js/portfolio.js"></script>
        
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script> 
        
        <!--[if lt IE 9]>
	       <script src="js/html5shiv.min.js"></script>
        <![endif]-->
        
    

        
        <!-- MailerLite Universal -->
            <script>
            (function(m,a,i,l,e,r){ m['MailerLiteObject']=e;function f(){
            var c={ a:arguments,q:[]};var r=this.push(c);return "number"!=typeof r?r:f.bind(c.q);}
            f.q=f.q||[];m[e]=m[e]||f.bind(f.q);m[e].q=m[e].q||f.q;r=a.createElement(i);
            var _=a.getElementsByTagName(i)[0];r.async=1;r.src=l+'?v'+(~~(new Date().getTime()/1000000));
            _.parentNode.insertBefore(r,_);})(window, document, 'script', 'https://static.mailerlite.com/js/universal.js', 'ml');

            var ml_account = ml('accounts', '1343738', 'o1f0a3m8d3', 'load');
            </script>
            <!-- End MailerLite Universal -->
    </head>
    <body>
      <header>
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
        
        
        
        