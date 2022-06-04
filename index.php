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
    "posts_per_page" => 5,
    "post_type" => "live-feed-updates",
    "post__in" => $feedid,
    "post_status" => "publish",
    "orderby" => "date",
    "order" => "DESC",
  ];
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
        <ul>            
        <?php while ($feed_updates->have_posts()):
          $feed_updates->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php
$feedTime = rwmb_meta("feed_time");
echo time_ago_calc($feedTime);
?>
          </li>
        <?php
        endwhile; ?>
        </ul>
      <?php endif;
      ?>



      </div>
    </div>



    <div class="newsBar">

      <div class="newsInner">Never Miss An Update</div>

    </div>

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
  "category_name" => $primary_category->slug,
  "posts_per_page" => 6,
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
          ?>

          <div class="aBlock">
            AD BLOCK
          </div>

          <div class="mainUpdates">

          <?php
          $latestPosts = new WP_Query($latest_post_args);

          if ($latestPosts->have_posts()):
            while ($latestPosts->have_posts()):
              $latestPosts->the_post(); ?>
            
                  
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
            endwhile;
          endif;

          wp_reset_postdata();
          ?>           
            
           
          </div> 
          <div class="newsArticle">Read More <?php echo $current_season; ?> News Here</div>
        </div>
      </div>
    </div>

  
    
    <div class="newsBar">

      <div class="newsInner">Never Miss An Update</div>

    </div>




    <!-- Main Section   -->
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
  </div>



  <?php get_template_part("template-parts/sidebar-main"); ?>



</div>


<?php get_footer();
