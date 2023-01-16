<?php
get_header(); ?>



<div class="bbj-container-inner">


<?php while (have_posts()):
  the_post(); ?>
  <section id="blog-post" class="rounded-md w-full flex flex-col lg:flex-row bg-white">
    <div class="container mx-auto relative border border-purple-500">
      


      
      <div class="absolute top-4 w-full pl-4"><?php if (function_exists("yoast_breadcrumb")) {
        yoast_breadcrumb('<p id="breadcrumbs-new">', "</p>");
      } ?>
      </div>

      <div class="absolute top-64 w-full">
        <h1 class="text-3xl font-bold mb-1 text-white pl-4"><?php the_title(); ?></h1>
        <div class="text-white pl-6 mb-2 text-sm"><?php the_modified_date(); ?> | <A href="#wpd-threads" class="text-second500 hover:text-secondHard !underline underline-offset-2"><?php echo $post->comment_count; ?> 
        Comments</a></div>  
      </div> 
      
      <?php if (has_post_thumbnail()): ?>
      <div class="featured-image h-[450px]" style="background-image: url('<?php the_post_thumbnail_url("featured-image-header"); ?>'); background-size: cover;"></div>
      <?php else: ?>
      <div class="bg-primary500 h-[450px]"></div>
      <?php endif; ?>  
      
      
      <div class="blog-post mx-auto bg-white w-11/12 rounded-xl p-2 z-10  mb-10 -mt-[100px]">
        <div class="flex justify-between border-b border-gray-200 p-2">
          <div class="flex justify-center items-center">
              <?php
              $author_id = get_the_author_meta("ID");
              $avatar_url = get_avatar_url($author_id, ["size" => 32]);
              ?>
            <div><img src="<?php echo $avatar_url; ?>"class="rounded-full w-8 h-8 mr-2"alt="Author Avatar"></div>
            <div>By <span class="font-bold">Steve Beans</span></div>  
          </div>
        </div>
        <div>
            <!-- socials -->
        </div>


        <div class="prose-xl prose-slate"> 
          <?php the_content(); ?>  
        </div>
      </div>




      

    </div>  

      <div class="w-80 p-2 border-l border-gray-200">
          
          <?php get_template_part("template-parts/sidebar-default"); ?>

      </div>

</section>
        <?php
endwhile;
// End the loop.
?>
</div>

<div class="body-regular" id="post-<?php the_ID(); ?>">


sdfsd
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
              <div><span><A href="#wpd-threads"><?php echo $post->comment_count; ?> Comments</span></a></div>
              
            </div>

            <div class="post-content">

            <?php get_template_part("template-parts/single-blog-post"); ?>
            </div>

            <h3>Related Posts</h3>
            <div class="related-posts">
              <?php example_cats_related_post(); ?>
            </div>
          </div>
        </div>
    </div>
  </article>


  
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
