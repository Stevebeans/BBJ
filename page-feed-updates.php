<?php get_header(); 

$curSeason = currentSeason("name");
$curSeasonID = currentSeason("ID");


$user_id = get_current_user_id();
$posts_per_page = get_user_meta($user_id, 'feed_update_count', true);
?>


<div class="bbj-container-inner">


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      <div class="mt-6">
          <h1 class="font-mainHead text-3xl text-primary500"><?= $curSeason ?> Live Feed Updates</h1>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>    


        <div id="new-feed-updates"></div>

        <?php
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;

        $args = [
          "post_type" => "live-feed-updates",
          "posts_per_page" => $posts_per_page,
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
          <?php $post_time_data = my_post_time_ago_function(); ?>


          <div class="my-4 p-1 border-l-8 border-gray-200 hover:bg-slate-200 border-t border-b rounded-md">         
          <div class="bg-gray-100 p-1">
            <div class="text-xs ">
            <?php 
                echo get_the_date('m/d/y h:ia');
            ?>
            (<span class="<?php echo $post_time_data["class"] ?>"><?php echo $post_time_data["time_diff"] ?></span>)
            </div>
            <div class="text-xs">
              By: <?php the_author(); ?>
            </div>
          </div>

            <div class="text-sm"><?php the_title(); ?></div>
            <div class="text-center"><?php
              if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(null, 'large', array( 'class' => 'text-center mx-auto rounded-lg my-1' ));
              }
            ?></div>
            <div class="text-sm " id="main-page-feed"><?= get_the_content() ?></div>

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
