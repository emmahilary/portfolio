<div class="thumbnail">
   

     <a href="<?php if ( CLEAN_URLS ):
                        echo 'post/' . name_to_url( $row ['project_name']);
                    else:    
                        echo 'post.php?name=' . name_to_url( $row ['project_name']);
                    endif;?>">
         
    <div class="post-info"><h3 class="project_name"><?php echo $row[ 'project_name' ] ?></h3>
    <p class="view-more">
    View Project Documentation</p></div>
    
    <div class="post-image">
        <img class="feature-img responsive" src="/uploads/<?php echo $row[ 'image' ]?>" alt="Feature Image">
    </div>
    
    </a>
    
    <div class="clear"></div>
</div>