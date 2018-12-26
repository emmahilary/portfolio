<?php 
 require ( 'includes/templates/page-top.tpl.php' ); ?>
           
           <main>
            <!-- blog post being -->
            <div class="page-header">
                <h1 class="blog-name"><?php echo $row[ 'project_name' ] ?></h1>
                <h5><?php echo $row[ 'skills' ]  ?></h5>
            </div>
               
               <article class="post-content">
            

                <img src="/uploads/<?php echo $row[ 'image' ]?>" alt="Feature Image">
                
                <h2 class="project-name"><?php echo $row[ 'project_name' ] ?></h2>
                
                <div class="content"><?php echo $row[ 'content' ] ?></div>
                
                <a class="live-site" href="<?php echo $row[ 'live_site' ] ?>" target="_blank">VIEW LIVE</a>
                
                <h5 class="return-button"><a href="../../portfolio.php">return to portfolio</a></h5>
                   
            </article>
            <!-- portfolio post ends -->
            
            <?php  //endwhile; ?>
        </main>
<?php require ( 'includes/templates/page-bottom.tpl.php' ); ?>