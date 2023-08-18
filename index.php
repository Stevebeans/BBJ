<?php

get_header(); ?>


<?php
$curSeason = currentSeason("name");
$curSeasonID = currentSeason("ID");

$user_id = get_current_user_id();
$posts_per_page = get_user_meta($user_id, 'feed_update_count', true);
?>



<div class="bbj-container-inner">
<?php if (feedUpdater()): ?>
  <div id="index-feed-updater"></div>
<?php endif; ?>
<?php if (!is_paged()): ?>
	<div class="mt-2 flex w-full flex-col bg-white lg:flex-row overflow-hidden ">
    <section id="main-left" class="w-full flex-grow">
      <h1 class="font-mainHead text-4xl text-primary500 p-2"><a href="<?= get_permalink($curSeasonID) ?>"><?= $curSeason ?></a> Spoilers</h1>
      
      <!-- Feed Updates and Featured Post block -->
      <div class="flex flex-grow p-2 flex-col " id="main-feeds">   
        <?php
        $args = [
          "post_type" => "post",
          "post_status" => "publish",
          "posts_per_page" => 5,
          "orderby" => "modified",
          "order" => "DESC",
        ];

        $recent_posts_query = new WP_Query($args);
        $recent_posts = $recent_posts_query->posts;

        // Featured Post
        $featured_post = array_shift($recent_posts);

        global $post;
        $post = $featured_post;
        setup_postdata($post);
        ?>
        <div id="highlight-posts" class="w-full  flex-grow mt-4 md:mt-0">
          <h2 class="font-mainHead text-2xl text-primary500">Latest Post</h2>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>

          <!-- Featured Post -->
          <div class="w-full bg-neutral-100 shadow-frontBox flex flex-col md:flex-row p-1 md:p-2">
            <div class="w-full md:w-[350px] flex-shrink-0"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" class="w-full h-[225px] rounded-md" alt="<?= $curSeason ?> featured post"></a></div>
            <div class="flex flex-col min-h-[225px] h-full px-1 md:px-2">
              <h2 class="font-mainHead text-2xl font-bold mt-2 md:mt-0"><a href="<?php the_permalink(); ?>"><?= $featured_post->post_title ?></a></h2>
              <?php $post_time_data = my_post_time_ago_function(); ?>
              <div class="font-ibm text-sm <?= $post_time_data["class"] ?>"><?= $post_time_data["time_diff"] ?></div>
              <div class="text-sm flex-grow"><?php echo wp_trim_words(get_the_content(), 85, "..."); ?> <span class="read-more"><a href="<?php the_permalink(); ?>" >Read More...</a></span></div>
              <div class="flex justify-between font-ibm text-sm mt-auto">
                  <div>By: <?= get_the_author_meta("display_name") ?></div>
                  <div><?= $featured_post->comment_count ?> comments</div>
              </div>
            </div>
          </div>

          <?php wp_reset_postdata(); ?>
        </div>

        <div class="my-6">
          <?php show_front_responsive(); ?>
        </div>


        <!-- Live Feed Update Block -->
        <div id="feed-updates" class="w-full">

          <h3 class="font-mainHead text-2xl text-primary500">Live Feed Updates</h3>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>


          <div class="text-xs">Showing the last <?= $posts_per_page ?> Updates <?php echo !premiumCheck() ? '' : '(<a href="/user-dashboard" class="text-blue-600 font-bold underline visited:text-blue-700 hover:underline">change</a>)' ?></div>
          <div class="">
          <?php
          $args = [
            "post_type" => "live-feed-updates",
            "posts_per_page" => $posts_per_page,
            "orderby" => "modified",
            "order" => "DESC",
          ];
          $feed_updates = new WP_Query($args);
          ?>

          <?php if ($feed_updates->have_posts()): ?>
            <?php 
            $counter = 0;
            while ($feed_updates->have_posts()):
              $feed_updates->the_post(); 
              ?>
            <?php $post_time_data = my_post_time_ago_function(); ?>


            <div class="my-4 p-1 border-l-8 border-gray-200 hover:bg-slate-200 border-t border-b rounded-md">
            <div class="bg-gray-100 p-1">
              <div class="text-xs md:hidden">
              <?php 
                  echo get_the_date('m/d/y h:ia');
              ?>
              </div>
              <div class="text-xs">
              <span class="<?php echo $post_time_data["class"] ?>"><?php echo $post_time_data["time_diff"] ?></span>
              </div>
              <div class="text-xs">
                By: <?php the_author(); ?>
              </div>
            </div>
            <div class="text-sm">
              
              <span id="title-<?= get_the_ID(); ?>"><?php the_title(); ?></span>
              <!-- Hidden Input for Title Edit -->
              <input type="text" id="title-input-<?= get_the_ID(); ?>" value="<?php echo esc_attr(get_the_title()); ?>" style="display: none;">
              
              <!-- Only display edit link if user has permission -->
              <?php if (feedUpdater()): ?>
                <a href="#" class="edit-title" data-id="<?= get_the_ID(); ?>">Edit</a>
              <?php endif; ?>
            </div>
            <div class="text-center"><?php
              if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(null, 'large', array( 'class' => 'text-center mx-auto rounded-lg my-1' ));
              }
            ?></div>
            <div class="text-sm" id="content-wrapper-<?= get_the_ID(); ?>">
                <div id="content-<?= get_the_ID(); ?>"><?= get_the_content(); ?></div>
                <!-- Hidden Textarea for Content Edit -->
                <textarea id="content-input-<?= get_the_ID(); ?>" style="display: none;" class="border border-purple-400 w-full"><?php echo esc_textarea(get_the_content()); ?></textarea>

                <!-- Only display edit link if user has permission -->
                <?php if (feedUpdater()): ?>
                  <a href="#" class="edit-content" data-id="<?= get_the_ID(); ?>">Edit</a>
                <?php endif; ?>

                <!-- Save Button -->
                <button id="save-changes-<?= get_the_ID(); ?>" style="display: none;">Save Changes</button>


              </div>
            </div>

            <?php 
            $counter++;

            if (!premiumCheck() && ($counter === 4 || $counter === 9)){
              show_front_feed_updates();
            }
            endwhile;
            wp_reset_postdata(); 
             endif; ?>

        </div>

        <?php if (feedUpdater()): ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Event listener for edit title links
    document.querySelectorAll('.edit-title').forEach(function(editLink) {
        editLink.addEventListener('click', function(e) {
            e.preventDefault();
            let postID = this.getAttribute('data-id');
            
            document.querySelector('#title-' + postID).style.display = 'none';
            document.querySelector('#title-input-' + postID).style.display = 'block';
            document.querySelector('#save-changes-' + postID).style.display = 'block';
        });
    });

    // Event listener for edit content links
    
    document.querySelectorAll('.edit-content').forEach(function(editLink) {
        editLink.addEventListener('click', function(e) {
            e.preventDefault();
            let postID = this.getAttribute('data-id');
            
            document.querySelector('#content-wrapper-' + postID + ' > #content-' + postID).style.display = 'none';

            document.querySelector('#content-input-' + postID).style.display = 'block';
            document.querySelector('#save-changes-' + postID).style.display = 'block';
        });
    });

    // Save Changes
    document.querySelectorAll('[id^="save-changes-"]').forEach(function(saveButton) {
        saveButton.addEventListener('click', function() {
            let postID = this.getAttribute('id').split('-')[2];
            let title = document.querySelector('#title-input-' + postID).value;
            let content = document.querySelector('#content-input-' + postID).value;

            // Moved the fetch function here, inside the save button event listener
            fetch(playerData.root_url + '/wp-json/wp/v2/live-feed-updates/' + postID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': playerData.nonce  // Using localized nonce
                },
                body: JSON.stringify({
                    title: title,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                // Handle successful post update.
                // Update the visible title and content with the updated ones.
                document.querySelector('#title-' + postID).textContent = title;
                document.querySelector('#content-' + postID).innerHTML = data.content.rendered;

                // Switch back to viewing mode
                document.querySelector('#title-' + postID).style.display = 'block';
                document.querySelector('#title-input-' + postID).style.display = 'none';
                document.querySelector('#content-wrapper-' + postID + ' > #content-' + postID).style.display = 'block';
                document.querySelector('#content-input-' + postID).style.display = 'none';
                document.querySelector('#save-changes-' + postID).style.display = 'none';
                window.location.reload();
            })
            .catch(error => {
                console.error('Error updating post:', error);
            });
        });
    });
});



</script>
        <?php endif; ?>


        <div class="text-center text-sm"><a href="/feed-updates" class="text-blue-600 font-bold underline hover:underline visited:text-blue-700">View more updates here</a></div>


        <div id="more-posts" class="w-full mt-6 border-t border-gray-200 pt-4">
        
          <h3 class="font-mainHead text-2xl text-primary500">More Stories & News</h3>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>

          <?php
          $paged = get_query_var("paged") ? get_query_var("paged") : 1;

          $counter = 0;

          // Set the number of posts per page
          $posts_per_page = 10;

          // Calculate the offset

          if ($paged == 1) {
            $offset = 1; // For front page, offset 5 featured posts
          } else {
            $offset = ($paged - 1) * $posts_per_page + 2; // For pages 2 and beyond, start from where the front page left off
          }

          // Set the query arguments
          $args = [
            "posts_per_page" => $posts_per_page,
            "offset" => $offset,
            "orderby" => "modified",
            "order" => "DESC",
            "paged" => $paged,
          ];

          $second_latest_post = new WP_Query($args);
          $first_page_link = get_pagenum_link(1);
          $max_num_pages = $second_latest_post->max_num_pages;
          echo '<div class="w-full flex gap-3 mb-4 justify-between">';
          if ($paged > 1) {
            $previous_page = $paged - 1;
            $previous_page_link = get_pagenum_link($previous_page);
            echo '<a href="' . $previous_page_link . '" class="back-button"><i class="fa-solid fa-angles-left"></i> Back</a>';
            echo '<a href="' . $first_page_link . '" class="first-page-button"><i class="fa-solid fa-house"></i> Home</a>';
          }
          if ($paged < $max_num_pages) {
            $next_page = $paged + 1;
            $next_page_link = get_pagenum_link($next_page);
            echo '<a href="' . $next_page_link . '" class="next-page-button">Next Page <i class="fa-solid fa-angles-right"></i></a>';
          }
          echo "</div>";

          if ($second_latest_post->have_posts()):
            while ($second_latest_post->have_posts()):

              $second_latest_post->the_post();
              $counter++;
              $post_time_data = my_post_time_ago_function();
          ?>
          <div class="border-b border-gray-300 flex flex-col md:flex-row py-4">
            <div class="flex-shrink-0 w-full md:w-[250px] "><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" class="w-full h-[150px]" alt="<?php esc_attr(the_title()); ?>"></a></div>
            <div class="grid grid-cols-2 w-full pl-2">
              <!-- First row -->

              <?php $categories = get_the_category(); ?>
              <div class="font-ibm text-sm text-left text-gray-500"><?php echo !empty($categories) ? esc_html($categories[0]->name) : "Uncategorized"; ?></div>
              <div class="font-ibm text-sm text-right text-gray-500"><?= $post_time_data["time_diff"] ?></div>
              
              <!-- Second row -->
              <div class="col-span-2">
                <div class="font-mainHead text-2xl"><a href="<?php the_permalink(); ?>"><h2><?php esc_attr(the_title()); ?></a></div>
                <div class="text-sm"><?= wp_trim_words(get_the_content(), 55, "...") ?></div>
              </div>
              
              <!-- Third row -->
              <div class="font-ibm text-sm text-gray-500  text-left"><?= get_the_author_meta("display_name") ?></div>
              <div class="font-ibm text-sm text-gray-500  text-right"><?= comments_number("No comments", "1 comment", "% comments") ?></div>
            </div>
          </div>

          <?php
              if ($counter == 4 || $counter == 9) {
                show_in_feed_ads();
              }
            endwhile;
          endif;
          ?>
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
          

          
      </div>
        

        
    </div>
    <!-- Feed Updates and Featured Post block end -->
      
    
    

    </section>
    <section id="sidebar" class="w-full md:w-[320px]  flex-shrink-0">
      <?php get_template_part("template-parts/sidebar-default"); ?>

      
    </section>
  </div>
  <?php endif; ?>

  
  
</div>





<?php get_footer();
