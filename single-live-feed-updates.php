<?php
get_header(); ?>

<div class="new-body-container" id="post-<?php the_ID(); ?>">

   <article>  
    <div class="widgetContain boxShadowsft">
        <div class="widgetHeader">
          <div class="titleBar"></div>
          <?php custom_breadcrumbs(); ?>
                       
        </div>
        <div class="widgetBody">
          <?php the_title('<h1 class="blogTitle">', "</h1>"); ?>

          <div class="entry-content">
          <?php get_template_part("template-parts/single-feed-update"); ?>
          </div>
        </div>
    </div>
  </article>




  
</div>
<?php get_footer();
