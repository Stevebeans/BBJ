<?php

get_header(); ?>



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
    "posts_per_Page" => 1,
    "post_type" => "live-feed-archives",
    "post_status" => "publish",
  ];
  ?>

  
    <!-- Live Feed Updates   -->
    <div class="widgetContain boxShadowsft">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">Live Feed Updates</h2>        
      </div>
      <?php get_template_part("template-parts/feed-update-form"); ?>

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

      <?php
      $feed_button = new WP_Query($feed_update_page);
      while ($feed_button->have_posts()):
        $feed_button->the_post(); ?>
        
      <a href="<?= the_permalink() ?>"><div class="front-view-more">View More Updates Here</div></a>
      <?php
      endwhile;
      ?>
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

$primary_category = rwmb_meta("current_category", ["object_type" => "setting"], "bbj_settings");
$current_season = $primary_category->name;

$latest_post_args = [
  "post_type" => "post",
  "post_status" => "publish",
  "posts_per_page" => 10,
];
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


          <?php get_template_part("template-parts/google-flex"); ?>


          <div class="mainUpdates">

          <?php
          if (have_posts()): ?>            
            <?php while (have_posts()):
              the_post(); ?>
            
                  
            <div class="newsArticle flex flex-col">
              

            <div class="newsSecond"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" alt="<?php esc_attr(the_title()); ?>"></a></div>
              <div class="newsInfo2 flex-grow">              
                <div class="categoryInfo-sm"><?php echo $current_season; ?></div>
                <div class="coverHeadline"><a href="<?php the_permalink(); ?>"><h3><?php esc_attr(the_title()); ?></h3></a></div>
                <div class="coverExcerptSm flex-grow"><p><?php the_excerpt(); ?> <span><a href="<?php the_permalink(); ?>">Read More</a></span></p></div>
                <div class="frontMeta"><?php echo get_the_author_meta("display_name"); ?> <span class="timeStamp"> <?php the_modified_date(); ?></span></div>
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

  
    

    <?php get_template_part("template-parts/google-flex"); ?>




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


<?php get_footer();
