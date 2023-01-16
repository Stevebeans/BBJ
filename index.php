<?php

get_header(); ?>


<div class="bbj-container">
  
  <section id="front-hero" class="max-w-full rounded-md flex flex-col lg:flex-row gap-2">

    <div class="w-full lg:w-1/2 front-card relative">    
      <div class="heading-bg">
        <div class="heading-text">Latest Big Brother 24 News</div>
      </div>
      <div>

      <?php
      $args = [
        "posts_per_page" => 1,
        "orderby" => "date",
        "order" => "DESC",
      ];

      $latest_post = new WP_Query($args);

      if ($latest_post->have_posts()):
        while ($latest_post->have_posts()):
          $latest_post->the_post(); ?>
        
        <div class="bbj-category">Featured Post</div>
        <div><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" class="w-full" alt="<?php esc_attr(the_title()); ?>"></a></div>
        <div class="bbj-title"><h2><a href="<?php the_permalink(); ?>"><h2><?php esc_attr(the_title()); ?></a></h2></div>
        <div class="bbj-desc"><?php echo wp_trim_words(get_the_content(), 55, "..."); ?> <span class="read-more"><a href="<?php the_permalink(); ?>" >Read More...</a></span></div>
        <div class="bbj-meta"><span class="font-bold text-gray-600 "><?= get_the_author_meta("display_name") ?></span> <span class="font-ibm text-gray-400 ">| <?php the_modified_date(); ?> | <?= $latest_post->comment_count ?> comments</span></div>

        <?php
        endwhile;
      else:
         ?>

        <?= "No Posts Found" ?>

        <?php
      endif;
      wp_reset_postdata();
      ?>
      </div>    
    </div>


    <?php
    $args = [
      "post_type" => "live-feed-updates",
      "posts_per_page" => 5,
      "orderby" => "modified",
      "order" => "DESC",
    ];
    $feed_updates = new WP_Query($args);
    ?>


    <div class="w-full lg:w-1/2 front-card relative">
      <div class="heading-bg">
        <h2 class="heading-text">Latest Live Feed Updates</h2>
      </div>
      <div class="mt-2">
        
      <?php if ($feed_updates->have_posts()): ?>
        <?php while ($feed_updates->have_posts()):
          $feed_updates->the_post(); ?>
          <div class="p-2 border-b last:border-0 border-gray-400 flex gap-4 mb-4">          
            <div class="row-span-2 w-10 flex justify-center items-start">
              <div>
                <?php
                $author_id = get_the_author_meta("ID");
                $avatar_url = get_avatar_url($author_id, ["size" => 32]);
                ?>
                <img src="<?php echo $avatar_url; ?>"class="rounded-full w-10 h-10"alt="Author Avatar"> 
              </div>  
            </div>

            <div>
              
              <div class="text-red-500 text-sm"><?php echo the_modified_date(); ?></div>
              <div>
                <div class="text-gray-800 text-lg"><?php the_title(); ?></div>
                <div class="text-gray-800"><?php the_content(); ?></div>
              </div>
            </div>

          </div>
        <?php
        endwhile; ?>
        <?php else: ?>
        <p>No updates found</p>
      <?php endif; ?>
          <div class="flex justify-center items-center">
            <a href="http://"><div class="bbj-btn">View More Live Feed Updates Here</div></a>
          </div>
      <?php wp_reset_postdata(); ?>
      </div>
    </div>

  
  </section>


  <?php if (!premiumCheck()):
    get_template_part("template-parts/ads/ad-rectangle-box");
  endif; ?>


  <section id="front-body" class="max-w-full rounded-md flex flex-col lg:flex-row gap-2">

    <div class="w-full lg:w-3/4 front-card relative">    
      <div class="heading-bg">
        <div class="heading-text">Latest Big Brother 24 News</div>
      </div>
      <div class="flex flex-wrap md:grid md:grid-cols-2 gap-2">

      <?php
      // Get the current page number
      $paged = get_query_var("paged") ? get_query_var("paged") : 1;

      $counter = 0;

      // Set the number of posts per page
      $posts_per_page = 8;

      // Calculate the offset
      if ($paged == 1) {
        $offset = 1;
      } else {
        $offset = ($paged - 1) * $posts_per_page;
      }

      // Set the query arguments
      $args = [
        "posts_per_page" => $posts_per_page,
        "offset" => $offset,
        "orderby" => "date",
        "order" => "DESC",
        "paged" => $paged,
      ];

      $second_latest_post = new WP_Query($args);

      if ($second_latest_post->have_posts()) {
        while ($second_latest_post->have_posts()) {

          $second_latest_post->the_post();
          $counter++;
          ?>
      <div class="post-card">
        <div class="bbj-category text-sm">
          
        <?php
        $categories = get_the_category();
        if (!empty($categories)):
          $category = esc_html($categories[0]->name);
          echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . $category . "</a>";
        endif;
        ?>
        </div>
        <div><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" class="w-full h-[300px]" alt="<?php esc_attr(the_title()); ?>"></a></div>
        <div class="bbj-title"><h2><a href="<?php the_permalink(); ?>"><h2><?php esc_attr(the_title()); ?></a></h2></div>
        <div class="bbj-desc md:h-[150px]"><?php echo wp_trim_words(get_the_content(), 55, "..."); ?> <span class="read-more"><a href="<?php the_permalink(); ?>" >Read More...</a></span></div>
        <div class="bbj-meta"><span class="font-bold text-gray-600 "><?= get_the_author_meta("display_name") ?></span> <span class="font-ibm text-gray-400 ">| <?php the_modified_date(); ?> | <?= $latest_post->comment_count ?> comments</span></div>
 
      </div>
        <?php if (!premiumCheck() && $counter == 4): ?>
          <div class="md:col-span-2">
          <?php get_template_part("template-parts/ads/ad-flex"); ?>
          </div>
          <?php endif;
        }
      } else {
         ?>

        <?= "No Posts Found" ?>

        <?php
      }
      ?>
      </div>  

      <nav class="w-full flex items-center justify-between p-2">
        <div class="hidden md:block grow text-sm text-gray-700 dark:text-gray-200">
          <?php
          global $wp_query;
          $page = get_query_var("paged") ? get_query_var("paged") : 1;
          $page_count = $wp_query->max_num_pages;
          echo "Showing: ";
          echo sprintf("%d–%d of %d", ($page - 1) * get_option("posts_per_page") + 1, min($wp_query->found_posts, $page * get_option("posts_per_page")), $wp_query->found_posts);
          ?>
        </div>

        <div class="flex rounded-md shadow border border-gray-200 w-full max-w-[400px] mx-auto dark:border-gray-400">
        <?php
        $pagination_links = paginate_links([
          "base" => get_pagenum_link(1) . "%_%",
          "format" => "page/%#%/",
          "current" => $paged,
          "total" => $second_latest_post->max_num_pages,
          "prev_text" => '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>',
          "next_text" => '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>',
          "type" => "array",
        ]);

        if (!empty($pagination_links)) {
          foreach ($pagination_links as $link) {
            echo '<div class="page-num">' . $link . "</div>";
          }
        }
        ?>
        </div>
      </nav>
      



    </div>


    <div class="w-full lg:w-1/4 front-card relative">
      <div class="mt-2">
      
      <?php get_template_part("template-parts/sidebar-default"); ?>

      </div>
    </div>

  </section>

</div>



<?php get_footer();
