<?php
get_header(); ?>

<div class="body-regular" id="post-<?php the_ID(); ?>">

   <article>  
    <div class="widgetContain boxShadowsft">
        <div class="widgetHeader">
          <div class="titleBar"></div>
          <?php custom_breadcrumbs(); ?>
                       
        </div>
        <div class="widgetBody">
          <?php the_title('<h1 class="blogTitle">', "</h1>"); ?>


          <div class="entry-content">
            <div class="featured-image">
              <?php if (has_post_thumbnail()) {
                the_post_thumbnail();
              } ?>                  
            </div>
            <div class="post-meta">
              <?php $get_author_id = $post->post_author; ?>
              <div><img src="<?php echo esc_url(get_avatar_url($get_author_id, ["size" => 15])); ?>" height="20"/></div>
              <div><?php echo get_the_author_meta("display_name"); ?></div>
              <div class="spacer"><div class="spacer-inner"></div></div>
              <div><span><?php the_modified_date(); ?></span></div>              
              <div class="spacer"><div class="spacer-inner"></div></div>
              <div><span><?php echo $post->comment_count; ?> Comments</span></div>
              
            </div>

            <div class="post-content">

                <?php the_content(); ?>
            </div>

            <h3>Related Posts</h3>
            <div class="related-posts">
              <?php example_cats_related_post(); ?>
            </div>
          </div>
        </div>
    </div>
  </article>


  <?php get_template_part("template-parts/sidebar-pages"); ?>


  
</div>
  <div class="post-bottom">
    <div class="comment-section">
      <?php if (comments_open()):
        comments_template();
      endif; ?>
    </div>

    <aside class="comment-aside">
      Comment Stuff
    </aside>
  </div>
<?php get_footer();
