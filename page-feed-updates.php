<?php get_header(); ?>


<div class="bbj-container-inner">


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      <div class="mt-6">
        <div class="heading-bg">
          <h1 class="heading-text"><a href="<?= site_url() ?>" class="hover:text-primarySoft">Home</a> >> Latest Live Feed Updates</h1>
        </div>    


        <div id="new-feed-updates"></div>
        
      </div>
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
