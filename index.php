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


    <div class="w-full lg:w-1/2 front-card relative">
      <div class="heading-bg">
        <h2 class="heading-text">Latest Live Feed Updates</h2>
      </div>
      <div class="mt-10">sdf</div>
    </div>

  
  </section>


  <section id="email-section" class="my-4 bg-primary500 rounded-sm max-w-5xl mx-auto p-2">
    Get Big Brother Feed Updates Sent Directly to your inbox
  </section>


  <section id="front-body" class="max-w-full rounded-md flex flex-col lg:flex-row gap-2">

    <div class="w-full lg:w-3/4 front-card relative">    
      <div class="heading-bg">
        <div class="heading-text">Latest Big Brother 24 News</div>
      </div>
      <div class="flex flex-wrap md:grid md:grid-cols-2 gap-2">

      <?php
      // Get the current page number
      $paged = get_query_var("paged") ? get_query_var("paged") : 1;

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
          $second_latest_post->the_post(); ?>
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
        <?php
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
      <div class="heading-bg">
        <h2 class="heading-text">Sidebar</h2>
      </div>
      <div class="mt-10">sdf</div>
    </div>

  </section>

</div>



<div class="bodyContainer">



  <!-- Main   -->
  <div class="mainBody">


  <?php
  // Get query for the live feed updates post
  global $wpdb;
  $feedid = $wpdb->get_col("SELECT ID FROM wp_bbj_feedupdates");
  $feed_updates_args = [
    "posts_per_page" => 10,
    "post_type" => "live-feed-updates",
    "post_status" => "publish",
    "orderby" => "modified",
    "order" => "DESC",
  ];

  $feed_update_page = [
    "posts_per_page" => 2,
    "post_type" => "live-feed-archives",
    "post_status" => "publish",
    "orderby" => "date",
    "order" => "DESC",
  ];
  ?>




  
 <!-- Live Feed Updates   -->
 <div class="widgetContain boxShadowsft">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">Latest Feed Discussion Thread</h2>        
      </div>

      <div class="widgetBody">

      <?php
      $featured_post_args = [
        "posts_per_page" => 1,
        "post_type" => "post",
        "post_status" => "publish",
        "orderby" => "date",
        "order" => "DESC",
        "no_found_rows" => true,
      ];

      $featured_post = new WP_Query($featured_post_args);
      if ($featured_post->have_posts()):
        $featured_post->the_post(); ?>
        <div class="featured-contain">
            <div class="newsArticle">
              <div class="newsFeatured"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" alt="<?php esc_attr(the_title()); ?>"></a></div>
              <div class="newsInfo">            
                <div class="categoryInfo">Live Feed Discussion</div>
                <div class="coverHeadline"><a href="<?php the_permalink(); ?>"><h2><?php esc_attr(the_title()); ?></h2></a></div>
                <div class="coverExcerpt"><p><?php echo wp_trim_words(get_the_content(), 55, "..."); ?> <span><a href="<?php the_permalink(); ?>">Read More</a></span></p></div>
                <div class="frontMeta"><?php echo get_the_author_meta("display_name"); ?> <span class="timeStamp"> <?php the_modified_date(); ?> | <?= $post->comment_count ?> comments</span></div>
              </div>
            </div>
          </div>
          <?php
      endif;
      wp_reset_postdata();
      ?>
      </div>
    </div>

    <?php
//get_template_part("template-parts/ads/ad-index-top");
?>

    <!-- Live Feed Updates   -->
    <div class="widgetContain boxShadowsft">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">Live Feed Updates</h2>        
      </div>

      <div class="widgetBody">

     

      <?php
      $feed_updates = new WP_Query($feed_updates_args);

      if ($feed_updates->have_posts()): ?>
      <?php while ($feed_updates->have_posts()):
        $feed_updates->the_post(); ?>
        <div class="front-feed-contain">
          <div class="date"><span class="timeStamp"><?php the_modified_date(); ?></span></div>
          <div class="body"><?php
          the_title();
          the_excerpt();
          ?></div>
        </div>
        <?php
      endwhile; ?>
      <?php endif;
      ?>

      <a href="/live-feed-updates/"><div class="front-view-more">Live Feed Archives</div></a>
      </div>
    </div>



    <?php get_template_part("template-parts/newsletter"); ?>

<?php
// Get query for the featured post

$featured_post_args = [
  "category_name" => "featured",
  "posts_per_page" => 1,
  "post_type" => "post",
  "post_status" => "publish",
  "orderby" => "date",
  "order" => "ASC",
  "no_found_rows" => true,
];

$primary_category = rwmb_meta("current_season", ["object_type" => "setting"], "bbj_settings");

$current_season = get_the_title($primary_category);

$latest_post_args = [
  "post_type" => "post",
  "post_status" => "publish",
  "posts_per_page" => 10,
  "offset" => 1,
];

$latest_posts = new WP_Query($latest_post_args);
?>



    
    <div class="widgetContain boxShadowsft">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">Latest <?php echo $current_season; ?> News</h2>        
      </div>
      <div class="widgetBody">
        
        <div>
          <!-- Featured Post   -->
          <?php
/*
          $featured_post = new WP_Query($featured_post_args);
          if ($featured_post->have_posts()):
            $featured_post->the_post(); ?>
          <div class="featured-contain">
            <div class="newsArticle">
              <div class="newsFeatured"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" alt="<?php esc_attr(the_title()); ?>"></a></div>
              <div class="newsInfo">            
                <div class="categoryInfo">Featured Story</div>
                <div class="coverHeadline"><a href="<?php the_permalink(); ?>"><h2><?php esc_attr(the_title()); ?></h2></a></div>
                <div class="coverExcerpt"><p><?php echo wp_trim_words(get_the_content(), 55, "..."); ?> <span><a href="<?php the_permalink(); ?>">Read More</a></span></p></div>
                <div class="frontMeta"><?php echo get_the_author_meta("display_name"); ?> <span class="timeStamp"> <?php the_modified_date(); ?></span></div>
              </div>
            </div>
          </div>
          <?php
          endif;
          wp_reset_postdata();
          */
?>


<?php
//get_template_part("template-parts/ads/ad-index-mid");
?>

          <div class="mainUpdates">

          <?php
          if ($latest_posts->have_posts()): ?>  


            <?php while ($latest_posts->have_posts()):
              $latest_posts->the_post(); ?>
            
            <div class="newsArticle flex flex-col">
              

            <div class="newsSecond"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" alt="<?php esc_attr(the_title()); ?>"></a></div>
              <div class="newsInfo2 flex-grow">              
                <div class="categoryInfo-sm"><?php echo $current_season; ?></div>
                <div class="coverHeadline"><a href="<?php the_permalink(); ?>"><h3><?php esc_attr(the_title()); ?></h3></a></div>
                <div class="coverExcerptSm flex-grow"><p><?php the_excerpt(); ?> <span><a href="<?php the_permalink(); ?>">Read More</a></span></p></div>
                <div class="frontMeta"><?php echo get_the_author_meta("display_name"); ?> <span class="timeStamp"> <?php the_modified_date(); ?> | <?= $post->comment_count ?> comments</span></div>
              </div>

            </div>

            <?php
            endwhile; ?>
             

          <?php endif;

          wp_reset_postdata();
          ?>           
            
 
  
          </div>  <div class="pagination"><?php ca_pagination(); ?></div>
        </div>
      </div>
    </div>

  
    

   




    <!-- Main Section   -->
    <?php
/* ?>
    <div class="widgetContain boxShadowsft">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">Lastest Entertainment News</h2>        
      </div>
      <div class="widgetBody">
        
        <div class="secondUpdates">
          <div class="newsArticle">
            

          <div class="newsSecond"><img src="<?php echo get_theme_file_uri("/images/test.webp"); ?>" alt="<?php echo get_bloginfo("description"); ?>"></div>
            <div class="newsInfo">
            
              <div class="categoryInfo">Big Brother 24</div>
              <div class="coverHeadline"><h3>Here is the Title to our Amazing Blog Post</h3></div>
              <div class="coverExcerptSm"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et eros tincidunt, hendrerit velit ac, dictum enim. Aenean sollicitudin, enim et r  <span><a href="#">Read More</a></span></p></div>
              <div class="frontMeta">Steve Beans <span class="timeStamp">5 hours ago</span></div>
            </div>

          </div>
          <div class="newsArticle third">            
            
            <div class="newsInfo">
            
              <div class="categoryInfo">Big Brother 24</div>
              <div class="coverHeadline"><h3>Here is the Title to our Amazing Blog Post</h3></div>
              
              <div class="frontMeta">Steve Beans <span class="timeStamp">5 hours ago</span></div>
            </div></div>
          <div class="newsArticle fourth">4</div>
          <div class="newsArticle fifth">5sdfsd</div>

          <div class="newsArticle sixth">Read More Big Brother 24 News Here</div>
        </div>


      </div>
    </div>
    */
?>
  </div>



  <?php get_template_part("template-parts/sidebar-main"); ?>


            
</div>

<div class="index-bottom"><?php
// get_template_part("template-parts/ads/ad-index-bottom");
?></div>
<?php get_footer();
