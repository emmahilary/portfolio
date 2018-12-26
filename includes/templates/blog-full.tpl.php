<?php 
 require ( 'includes/templates/page-top.tpl.php' ); ?>
           
           <main>
            <!-- blog post begin -->
            <div class="page-header">
                <h1 class="blog-name"><?php echo $row[ 'blog_title' ] ?></h1>
                <h5 class="blog-date"><?php echo date('F jS, Y', strtotime( $row[ 'blog_date' ] ) );  ?></h5>
            </div>
               
               
            <article class="post-content">
                
                <img src="/uploads/<?php echo $row[ 'blog_img' ]?>" alt="Feature Image">
                
                <h2 class="blog-name"><?php echo $row[ 'blog_title' ] ?></h2>
                
                <p class="post-excerpt"><?php echo $row[ 'blog_excerpt' ] ?></p>
            
                <div class="blog-post-content"><?php echo $row[ 'blog_content' ] ?></div>
                
                <h5 class="return-button"><a href="../../blog.php">return to blog</a></h5>
                
        
            <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    
var disqus_config = function () {
this.page.url = 'http://wip.emmahilary.com/blog_post/'<?php echo $row[ 'blog-name' ] ?>;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = <?php echo $row[ 'blog_id' ] ?>; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://www-emmahilary-com.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
           </article>
            <!-- portfolio post ends -->    
               
            <?php  //endwhile; ?>
        </main>
<?php require ( 'includes/templates/page-bottom.tpl.php' ); ?>