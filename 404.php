<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bigbrotherjunkies
 */

get_header();
// whatever21
?>

<div class="body-regular" id="post-<?php the_ID(); ?>">

   <article>  
    <div class="widgetContain boxShadowsft">
        <div class="widgetHeader">
          <div class="titleBar"></div>
          <?php custom_breadcrumbs(); ?>
                       
        </div>
        <div class="widgetBody">
          <?php the_title( '<h1 class="blogTitle">', '</h1>' ); ?>


          <div class="entry-content">
            <div class="featured-image">
              <?php 
                if (has_post_thumbnail())
                  the_post_thumbnail( ); 
                ?>                  
            </div>

            <div class="post-content">

                <?php 
                  the_content();
                ?>
            </div>

          </div>
        </div>
    </div>
  </article>



  <?php get_template_part( 'template-parts/sidebar-pages' )?>

  
</div>

<?php
get_footer();
