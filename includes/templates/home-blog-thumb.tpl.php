<div class="home-thumbnail">
   

     <a href="<?php if ( CLEAN_URLS ):
                        echo 'blog_post/' . name_to_url( $row ['blog_title']);
                    else:    
                        echo 'blog-post.php?name=' . name_to_url( $row ['blog_title']);
                    endif;?>">  
         
         
         
    <img class="home-blog-img" src="/uploads/<?php echo $row[ 'blog_img' ]?>" alt="Feature Image">
    <h2 class="home-blog-title"><?php echo $row[ 'blog_title' ] ?></h2>
    <h5 class="home-blog-date"><?php echo date('j/m/y ', strtotime( $row[ 'blog_date' ] ) );  ?></h5>
      
    </a>
    
</div>