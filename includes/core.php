<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package BBJTheme
 */

$playerTable = "wp_bbj_players";
$seasonTable = "wp_bbj_seasons";

add_filter("acf/update_value/type=date_time_picker", "my_update_value_date_time_picker", 10, 3);

function my_update_value_date_time_picker($value, $post_id, $field)
{
  return strtotime($value);
}

function my_post_time_ago_function()
{
  return sprintf(esc_html__("%s ago", "textdomain"), human_time_diff(get_the_modified_time("U"), current_time("timestamp")));
}
add_filter("the_modified_date", "my_post_time_ago_function");

function time_ago_calc($time)
{
  date_default_timezone_set("US/Eastern");
  $time = strtotime($time);
  return sprintf(esc_html__("%s ago", "textdomain"), human_time_diff($time, time()));
}

function show_age($dob, $start)
{
  $dob = new DateTime($dob);
  $start = new DateTime($start);

  $result = $dob->diff($start);

  $difference = $result->format("%y years old");

  return $difference;
}

function current_age($dob)
{
  $today = new DateTime();
  $dob = new DateTime($dob);

  $diff = $dob->diff($today);

  $currentAge = $diff->format("%y years old");

  return $currentAge;
}

function days_calc($enter, $exit)
{
  $earlier = new DateTime($enter);
  $later = new DateTime($exit);

  $abs_diff = $later->diff($earlier)->format("%a"); //3

  echo $abs_diff;
}

/**
 * Filter the excerpt length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
  return 30;
}
add_filter("excerpt_length", "wpdocs_custom_excerpt_length", 999);

function bidirectional_acf_update_value($value, $post_id, $field)
{
  // vars
  $field_name = $field["name"];
  $field_key = $field["key"];
  $global_name = "is_updating_" . $field_name;

  // bail early if this filter was triggered from the update_field() function called within the loop below
  // - this prevents an inifinte loop
  if (!empty($GLOBALS[$global_name])) {
    return $value;
  }

  // set global variable to avoid inifite loop
  // - could also remove_filter() then add_filter() again, but this is simpler
  $GLOBALS[$global_name] = 1;

  // loop over selected posts and add this $post_id
  if (is_array($value)) {
    foreach ($value as $post_id2) {
      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);

      // allow for selected posts to not contain a value
      if (empty($value2)) {
        $value2 = [];
      }

      // bail early if the current $post_id is already found in selected post's $value2
      if (in_array($post_id, $value2)) {
        continue;
      }

      // append the current $post_id to the selected post's 'related_posts' value
      $value2[] = $post_id;

      // update the selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
    }
  }

  // find posts which have been removed
  $old_value = get_field($field_name, $post_id, false);

  if (is_array($old_value)) {
    foreach ($old_value as $post_id2) {
      // bail early if this value has not been removed
      if (is_array($value) && in_array($post_id2, $value)) {
        continue;
      }

      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);

      // bail early if no value
      if (empty($value2)) {
        continue;
      }

      // find the position of $post_id within $value2 so we can remove it
      $pos = array_search($post_id, $value2);

      // remove
      unset($value2[$pos]);

      // update the un-selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
    }
  }

  // reset global varibale to allow this filter to function as per normal
  $GLOBALS[$global_name] = 0;

  // return
  return $value;
}

add_filter("acf/update_value/name=player_season", "bidirectional_acf_update_value", 10, 3);

/**
 *
 *   GET RELATED POSTS
 *
 *
 */
function example_cats_related_post()
{
  $post_id = get_the_ID();
  $cat_ids = [];
  $categories = get_the_category($post_id);

  if (!empty($categories) && !is_wp_error($categories)):
    foreach ($categories as $category):
      array_push($cat_ids, $category->term_id);
    endforeach;
  endif;

  $current_post_type = get_post_type($post_id);

  $query_args = [
    "category__in" => $cat_ids,
    "post_type" => $current_post_type,
    "post__not_in" => [$post_id],
    "posts_per_page" => "3",
  ];

  $related_cats_post = new WP_Query($query_args);

  if ($related_cats_post->have_posts()):
    while ($related_cats_post->have_posts()):
      $related_cats_post->the_post(); ?>

       <div class="related-post">
        <div><img src="<?php echo the_post_thumbnail_url("featured-thumbnail"); ?>" alt="<?php esc_attr(the_title()); ?>"></div>
        <div class="related-post-meta"> <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                  </a></div>
        <div class="related-post-meta"><span><?php the_modified_date(); ?></span></div> 
        
                 
                  
      </div>
      <?php
    endwhile;

    // Restore original Post Data
    wp_reset_postdata();
  endif;
}

/**
 *
 *   ADD MENU
 *
 *
 */

function bbj_menu_top()
{
  register_nav_menu("my-custom-menu", __("Top Menu"));
}
add_action("init", "bbj_menu_top");

function bbj_menu_footer()
{
  register_nav_menu("my-custom-footer", __("BBJ Footer Menu"));
}
add_action("init", "bbj_menu_footer");

function boilerplate_add_support()
{
  add_theme_support("title-tag");
  add_theme_support("post-thumbnails");
  add_theme_support("block-templates");

  add_image_size("featured-thumbnail", 400, 200, true);
  add_image_size("player-banner", 1200, 350, true);
  add_image_size("profile-picture", 200, 200, true);
  add_image_size("tiny", 50, 50, true);
}

add_action("after_setup_theme", "boilerplate_add_support");

/*   Season percentage calculator   */

function season_percentage($start, $finish, $evicted)
{
  $start = new DateTime($start);
  $finish = new DateTime($finish);
  $evicted = new DateTime($evicted);
  $today = new DateTime();

  $evictedDate = $evicted ? $evicted : $today;

  //var_dump($evictedDate);

  //var_dump($evicted);
  $daysIn = $start->diff($evicted)->format("%r%a");
  $diff = $start->diff($finish)->format("%r%a");

  $percentage = $daysIn / $diff;
  $percentage = round((float) $percentage * 100);

  return $percentage;
}

/**
 *
 *
 * Custom Comments
 *
 */

require_once get_parent_theme_file_path("/better-comments.php");

// MailPoet Checkbox to registration
add_action("um_after_profile_fields", "um_custom_add_register_form_hook");
function um_custom_add_register_form_hook()
{
  do_action(‘register_form’);
}

function ca_pagination()
{
  if (is_singular()) {
    return;
  }

  global $wp_query;

  $paged = get_query_var("paged") ? absint(get_query_var("paged")) : 1;
  $max = intval($wp_query->max_num_pages);

  /** Add current page to the array */
  if ($paged >= 1) {
    $links[] = $paged;
  }

  /** Add the pages around the current page to the array */
  if ($paged >= 5) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  echo '<div class="navigation"><ul>' . "\n";

  /** Previous Post Link */
  if (get_previous_posts_link()) {
    printf("<li>%s</li>" . "\n", get_previous_posts_link());
  }

  /** Link to first page */
  if (!in_array(1, $links)) {
    $class = 1 == $paged ? ' class="active"' : "";

    printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), "1");
  }

  /** Link to current page*/
  sort($links);
  foreach ((array) $links as $link) {
    $class = $paged == $link ? ' class="active"' : "";
  }

  /** Link to last page,*/
  if (!in_array($max, $links)) {
    if (!in_array($max - 1, $links)) {
      echo "<li>…</li>" . "\n";
    }

    $class = $paged == $max ? ' class="active"' : "";
  }

  /** Next Post Link */
  if (get_next_posts_link()) {
    printf("<li>%s</li>" . "\n", get_next_posts_link());
  }

  echo "</ul></div>" . "\n";
}

function isAdmin()
{
  if (is_user_logged_in()):
    $user = wp_get_current_user();
    if (current_user_can("administrator")):
      return true;
    endif;
  endif;
}

function premiumCheck()
{
  if (is_user_logged_in()):
    $user = wp_get_current_user();
    if (current_user_can("supporter") || current_user_can("editor") || current_user_can("administrator") || current_user_can("second_in_command")):
      return true;
    endif;
  endif;
}

function feedUpdater()
{
  if (is_user_logged_in()):
    $user = wp_get_current_user();
    if (current_user_can("administrator") || current_user_can("updater")):
      return true;
    endif;
  endif;
}
