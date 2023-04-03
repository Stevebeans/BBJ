<?php

get_header(); ?>


<?php
$curSeason = currentSeason("name");
$curSeasonID = currentSeason("ID");
?>



<div class="bbj-container-inner">
<?php if (!is_paged()): ?>
	<div class="mt-2 flex w-full flex-col bg-white lg:flex-row overflow-hidden">
    <section id="main-left" class="w-full flex-grow">
      <h1 class="font-mainHead text-4xl text-primary500 p-2"><a href="<?= get_permalink($curSeasonID) ?>"><?= $curSeason ?></a> Spoilers</h1>
      
      <!-- Feed Updates and Featured Post block -->
      <div class="flex flex-grow p-2 flex-col-reverse md:flex-row">   
             
        <!-- Live Feed Update Block -->
        <div id="feed-updates" class="w-full md:w-[210px] flex-shrink-0 md:border-r border-dotted border-slate-500">
          <h3 class="font-mainHead text-2xl text-primary500">Live Feed Updates</h3>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>
          <?php
          $args = [
            "post_type" => "live-feed-updates",
            "posts_per_page" => 7,
            "orderby" => "modified",
            "order" => "DESC",
          ];
          $feed_updates = new WP_Query($args);
          ?>
          <?php if ($feed_updates->have_posts()): ?>
            <?php while ($feed_updates->have_posts()):
              $feed_updates->the_post(); ?>
            <?php $post_time_data = my_post_time_ago_function(); ?>
          <div class="p-2 border-b last:border-0 border-gray-400 flex mb-4">          
            <div class="row-span-2 flex justify-center items-start">
              <div>
                <style>
                  .pp-user-avatar {
                    border-radius: 100%;
                    margin-right: 4px;
                    margin-top: 4px;
                  }
                </style>
                    <?php
                    $author_id = get_the_author_meta("ID");
                    $avatar_shortcode = '[avatar user="' . $author_id . '" size="16" link="file" align="center"]';
                    $avatar_url = do_shortcode($avatar_shortcode);
                    ?>
                   <?= $avatar_url ?>
              </div>  
            </div>

            <div class="w-full">     
              <div>
                <div class="text-gray-800"><?php the_title(); ?></div>
                <div class="text-gray-600 text-sm"><?php the_content(); ?></div>
                <div class="<?= $post_time_data["class"] ?> text-xs font-ibm"><?= $post_time_data["time_diff"] ?></div>
              </div>
            </div>

          </div>
          <?php
            endwhile; ?>
            <?php else: ?>
          <p>No updates found</p>
          <?php endif; ?>
          <div class="flex justify-center items-center">
            <a href="/feed-updates/"><div class="border border-primary500 rounded-3xl py-1 px-2 mr-2 flex justify-center bg-second500 items-center text-center text-sm font-bold hover:text-white">
              View More Live Feed Updates Here</div></a>
          </div>
        <?php wp_reset_postdata(); ?>

          
        </div>
        <!-- Live Feed Update Block End -->

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

        <!-- Featured Post Block -->
        <div id="highlight-posts" class="w-full  flex-grow pl-2 mt-4 md:mt-0">
          <h3 class="font-mainHead text-2xl text-primary500">Featured Post</h3>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>

          <!-- Featured Post -->
          <div class="w-full bg-neutral-100 shadow-frontBox flex flex-col md:flex-row p-1 md:p-2">
            <div class="w-full md:w-[350px] flex-shrink-0"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" class="w-full h-[225px] rounded-md" alt="<?= $curSeason ?> featured post"></a></div>
            <div class="flex flex-col min-h-[225px] h-full px-1 md:px-2">
              <h2 class="font-sans text-2xl font-bold mt-2 md:mt-0"><a href="<?php the_permalink(); ?>"><?= $featured_post->post_title ?></a></h2>
              <?php $post_time_data = my_post_time_ago_function(); ?>
              <div class="font-ibm text-sm <?= $post_time_data["class"] ?>"><?= $post_time_data["time_diff"] ?></div>
              <div class="text-sm flex-grow"><?php echo wp_trim_words(get_the_content(), 45, "..."); ?> <span class="read-more"><a href="<?php the_permalink(); ?>" >Read More...</a></span></div>
              <div class="flex justify-between font-ibm text-sm mt-auto">
                  <div>By: <?= get_the_author_meta("display_name") ?></div>
                  <div><?= $featured_post->comment_count ?> comments</div>
              </div>
            </div>
          </div>

          <?php wp_reset_postdata(); ?>

          <div id="newsletter-box" class="w-full bg-primary500 p-4 text-white my-4">
            <div class="flex">
              <div class="text-lg">Sign Up For Feed Updates Here</div>
              <style>
                #mailpoet_form_2 form.mailpoet_form {
                  margin-left: 4px;
                  padding: 4px !important;
                }

                #mailpoet_form_2 .mailpoet_form {
                  display: flex !important;
                }

                #mailpoet_form_2 .mailpoet_paragraph {
                  margin-bottom: 0 !important;
                  padding: 0 !important;
                }

                #mailpoet_form_2 .mailpoet_form_columns .mailpoet_form_column {
                  margin-bottom: 0 !important;
                  padding: 0 !important;
                }

              </style>
              <div><?= do_shortcode('[mailpoet_form id="2"]') ?></div>
            </div>
            <div class="text-sm">Get the latest updates from the <?= $curSeason ?> Live Feeds directly to your inbox</div>
          </div>

          <div class="my-4"><?php get_template_part("template-parts/ads/ad-flex"); ?></div>

          <h3 class="font-mainHead text-2xl text-primary500">More Featured <?= $curSeason ?> Stories</h3>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>

          
          <div class="w-full flex flex-col md:flex-row gap-3 mb-4">
            <?php for ($i = 0; $i < 4; $i++): ?>
              <?php $post = $recent_posts[$i]; ?>
              <?php $post_time_data = my_post_time_ago_function(); ?>

              <?php if ($i == 0 || $i == 3): ?>
                <!-- Block A -->
                
                <div class="w-full md:w-[65%] bg-neutral-100 flex-col md:flex-row shadow-frontBox flex overflow-hidden p-2">
                  
                  <div class="w-full md:w-[200px] flex-shrink-0"><a href="<?php the_permalink(); ?>"><img src="<?= the_post_thumbnail_url("featured-thumbnail") ?>" class="w-full h-[150px] rounded-md" alt="<?= $post->image_alt ?>"></a></div>
                  <div class="flex flex-col md:min-h-[150px] h-full px-1 md:px-2">
                    <h2 class="font-sans text-lg font-bold"><a href="<?php the_permalink(); ?>"><?= $post->post_title ?></a></h2>
                    <div class="font-ibm text-sm text-gray-500 flex-grow">
                      <?= $post_time_data["time_diff"] ?> <br />
                      By: <?= get_the_author_meta("display_name") ?> <br />
                      <?= $post->comment_count ?> Comments
                    </div>
                  </div>
                
                </div>
              <?php else: ?>
                <!-- Block B -->
                <div class="w-full md:w-[35%] bg-neutral-100 shadow-frontBox flex overflow-hidden p-2">
                  <div class="flex flex-col min-h-[150px] h-full px-2">
                    <div class="font-ibm text-sm text-gray-500"><?= $post_time_data["time_diff"] ?></div>
                    <div class="flex-grow">
                      <h2 class="font-sans text-xl font-bold"><a href="<?php the_permalink(); ?>"><?= $post->post_title ?></a></h2>
                    </div>
                    <div class="font-ibm text-sm text-gray-500">
                      By: <?= get_the_author_meta("display_name") ?> <br />
                      <?= $post->comment_count ?> Comments
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($i == 1): ?>
                <!-- Add a closing div for the first row and start a new row -->
                </div>
                <div class="w-full flex flex-col md:flex-row gap-3 mb-4">
              <?php endif; ?>
            <?php endfor; ?>
          </div>
          <?php wp_reset_postdata(); ?>

          <div class="my-4">
            <?php get_template_part("template-parts/ads/ad-flex"); ?>
          </div>

        </div>
        <!-- Featured Post Block End -->
      </div>
      <!-- Feed Updates and Featured Post block end -->
      

    </section>
    <section id="sidebar" class="w-full md:w-[320px]  flex-shrink-0">
      <?php get_template_part("template-parts/sidebar-default"); ?>
    </section>
  </div>
  <?php endif; ?>

  
  <div class="bg-white w-full <?= !is_paged() ? "pt-4" : "pt-0" ?>">
    <?php if (!is_paged()): ?>
    <div class="h-[1px] bg-gray-300 w-[85%] mx-auto"></div>
    <?php endif; ?>


    <div class="p-2 flex flex-col md:flex-row">
      <section id="more-posts" class="pr-2">
        <h3 class="font-mainHead text-2xl text-primary500">Latest Stories & News</h3>
        <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>

              <?php
              $paged = get_query_var("paged") ? get_query_var("paged") : 1;

              $counter = 0;

              // Set the number of posts per page
              $posts_per_page = 8;

              // Calculate the offset

              if ($paged == 1) {
                $offset = 5; // For front page, offset 5 featured posts
              } else {
                $offset = ($paged - 1) * $posts_per_page + 6; // For pages 2 and beyond, start from where the front page left off
              }

              // Set the query arguments
              $args = [
                "posts_per_page" => 8,
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
                  ?>
                  <?php $post_time_data = my_post_time_ago_function(); ?>

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

      </section>

      <section class="w-full md:w-[300px] flex-shrink-0 p-2 border-l border-dotted border-slate-500">
      
        <h3 class="font-mainHead text-2xl text-primary500">Big Brother Stats</h3>
        <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>
      
        

        <?= do_shortcode("[bbj_stats]") ?>

        <div class="text-xs">More stats to come!</div>

      </section>
            
    </div>
  </div>
</div>





<?php get_footer();
