<div class="thumbnail">
   

     <a href="<?php if ( CLEAN_URLS ):
                        echo 'blog_post/' . name_to_url( $row ['blog_title']);
                    else:    
                        echo 'blog-post.php?name=' . name_to_url( $row ['blog_title']);
                    endif;?>">  
         
    <div class="post-info">
    <h3 class="blog_title"><?php echo $row[ 'blog_title' ] ?></h3>
    <h5 class="blog-date"><?php echo date('F jS, Y', strtotime( $row[ 'blog_date' ] ) );  ?></h5>
    <p class="blog-excerpt"><?php echo $row[ 'blog_excerpt' ] ?></p></div>
         
         
         
    <div class="post-image">
    <img class="feature-img responsive" src="/uploads/<?php echo $row[ 'blog_img' ]?>" alt="Feature Image">
    </div>
         
    </a>
    
    <div class="clear"></div>
</div>