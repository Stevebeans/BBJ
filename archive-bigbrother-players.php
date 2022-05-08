<?php
get_header();
?>

<div class="body-regular" id="post-<?php the_ID(); ?>">

   <article>  
    <div class="widgetContain boxShadowsft">
        <div class="widgetHeader">
          <div class="titleBar"></div>
          <?php custom_breadcrumbs(); ?>
                       
        </div>
        <div class="widgetBody">


          <div class="entry-content">

            <div class="post-content">
              <div id="player-table"></div>
            </div>

           
          </div>
        </div>
    </div>
  </article>


  
  <?php get_template_part( 'template-parts/sidebar-pages' )?>


  
</div>
<div class="post-bottom">
    <div class="comment-section">
      <?php 
        
        if ( comments_open() ):
          comments_template();
        endif;
      ?>
    </div>

    <aside class="comment-aside">
      Comment Stuff
    </aside>
  </div>
<?php
get_footer();