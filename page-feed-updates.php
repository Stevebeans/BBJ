<?php get_header(); ?>


<div class="bbj-container-inner">


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      <div class="mt-6">
        <div class="heading-bg">
          <h1 class="heading-text"><a href="<?= site_url() ?>" class="hover:text-primarySoft">Home</a> >> Latest Live Feed Updates</h1>
        </div>    


        <div id="new-feed-updates"></div>

        <?php
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;

        $args = [
          "post_type" => "live-feed-updates",
          "posts_per_page" => 15,
          "orderby" => "modified",
          "order" => "DESC",
          "paged" => $paged,
        ];
        $feed_updates = new WP_Query($args);
        $counter = 0;
        ?>
        

      <?php if ($feed_updates->have_posts()): ?>
        <?php while ($feed_updates->have_posts()):

          $feed_updates->the_post();
          $counter++;
          ?>


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

          <?php if (!premiumCheck() && ($counter == 3 || $counter == 8 || $counter == 14)): ?>
          <div class="md:col-span-2">
          <?php get_template_part("template-parts/ads/ad-in-article"); ?>
          </div>
          <?php endif; ?>
        <?php
        endwhile; ?>
      <?php else: ?>
        <p>No updates found</p>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
      </div>


      <nav class="w-full flex items-center justify-between p-2">
        <div class="hidden md:block grow text-sm text-gray-700 dark:text-gray-200">
          <?php
          $page = get_query_var("paged") ? get_query_var("paged") : 1;
          $page_count = $feed_updates->max_num_pages;
          echo "Showing: ";
          echo sprintf("%d–%d of %d", ($page - 1) * $feed_updates->query_vars["posts_per_page"] + 1, min($feed_updates->found_posts, $page * $feed_updates->query_vars["posts_per_page"]), $feed_updates->found_posts);
          ?>
        </div>

        <div class="flex rounded-md shadow border border-gray-200 w-full max-w-[400px] mx-auto dark:border-gray-400">
        <?php
        $pagination_links = paginate_links([
          "base" => get_pagenum_link(1) . "%_%",
          "format" => "page/%#%/",
          "current" => $paged,
          "total" => $feed_updates->max_num_pages,
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
        </nav>


    </div>



    <?php
    // Set the localstorage for lastViewedPostID for the latest post in the custom post type live-feed-updates using WP Query
    $args = [
      "post_type" => "live-feed-updates",
      "posts_per_page" => 1,
      "orderby" => "date",
      "order" => "DESC",
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      $post = $query->posts[0];

      // Save post ID to localStorage
      echo "<script>localStorage.setItem('lastViewedPostId', " . $post->ID . ");</script>";

      // Save timestamp to localStorage
      echo "<script>localStorage.setItem('lastViewedTimestamp', " . time() . ");</script>";
    }

    wp_reset_postdata();
    ?>


    <div>
      <?php get_template_part("template-parts/sidebar-default"); ?>
    </div>
  </div>


</div>


<?php get_footer(); ?>
