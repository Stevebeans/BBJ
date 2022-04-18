<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package BBJTheme
 */


$playerTable = 'wp_bbj_players';
$seasonTable = 'wp_bbj_seasons';


add_filter('acf/update_value/type=date_time_picker', 'my_update_value_date_time_picker', 10, 3);

function my_update_value_date_time_picker( $value, $post_id, $field ) {
    return strtotime( $value );
}

function my_post_time_ago_function() {
  return sprintf( esc_html__( '%s ago', 'textdomain' ), human_time_diff(get_the_modified_time ( 'U' ), current_time( 'timestamp' ) ) );
}
  add_filter( 'the_modified_date', 'my_post_time_ago_function' );


function time_ago_calc($time) {

  date_default_timezone_set('US/Eastern');
  $time = strtotime($time); 
  return sprintf( esc_html__( '%s ago', 'textdomain' ), human_time_diff($time, time() ) );
}

/**
* Filter the excerpt length to 20 words.
*
* @param int $length Excerpt length.
* @return int (Maybe) modified excerpt length.
*/
function wpdocs_custom_excerpt_length( $length ) {
  return 30;
  }
  add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



  function bidirectional_acf_update_value( $value, $post_id, $field  ) {
	
    // vars
    $field_name = $field['name'];
    $field_key = $field['key'];
    $global_name = 'is_updating_' . $field_name;
    
    
    // bail early if this filter was triggered from the update_field() function called within the loop below
    // - this prevents an inifinte loop
    if( !empty($GLOBALS[ $global_name ]) ) return $value;
    
    
    // set global variable to avoid inifite loop
    // - could also remove_filter() then add_filter() again, but this is simpler
    $GLOBALS[ $global_name ] = 1;
    
    
    // loop over selected posts and add this $post_id
    if( is_array($value) ) {
    
      foreach( $value as $post_id2 ) {
        
        // load existing related posts
        $value2 = get_field($field_name, $post_id2, false);
        
        
        // allow for selected posts to not contain a value
        if( empty($value2) ) {
          
          $value2 = array();
          
        }
        
        
        // bail early if the current $post_id is already found in selected post's $value2
        if( in_array($post_id, $value2) ) continue;
        
        
        // append the current $post_id to the selected post's 'related_posts' value
        $value2[] = $post_id;
        
        
        // update the selected post's value (use field's key for performance)
        update_field($field_key, $value2, $post_id2);
        
      }
    
    }
    
    
    // find posts which have been removed
    $old_value = get_field($field_name, $post_id, false);
    
    if( is_array($old_value) ) {
      
      foreach( $old_value as $post_id2 ) {
        
        // bail early if this value has not been removed
        if( is_array($value) && in_array($post_id2, $value) ) continue;
        
        
        // load existing related posts
        $value2 = get_field($field_name, $post_id2, false);
        
        
        // bail early if no value
        if( empty($value2) ) continue;
        
        
        // find the position of $post_id within $value2 so we can remove it
        $pos = array_search($post_id, $value2);
        
        
        // remove
        unset( $value2[ $pos] );
        
        
        // update the un-selected post's value (use field's key for performance)
        update_field($field_key, $value2, $post_id2);
        
      }
      
    }
    
    
    // reset global varibale to allow this filter to function as per normal
    $GLOBALS[ $global_name ] = 0;
    
    
    // return
      return $value;
      
  }
  
  add_filter('acf/update_value/name=player_season', 'bidirectional_acf_update_value', 10, 3);


/**
 * 
 *   GET RELATED POSTS
 * 
 * 
 */
function example_cats_related_post() {

  $post_id = get_the_ID();
  $cat_ids = array();
  $categories = get_the_category( $post_id );

  if(!empty($categories) && !is_wp_error($categories)):
      foreach ($categories as $category):
          array_push($cat_ids, $category->term_id);
      endforeach;
  endif;

  $current_post_type = get_post_type($post_id);

  $query_args = array( 
      'category__in'   => $cat_ids,
      'post_type'      => $current_post_type,
      'post__not_in'    => array($post_id),
      'posts_per_page'  => '3',
   );

  $related_cats_post = new WP_Query( $query_args );

  if($related_cats_post->have_posts()):
       while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>

       <div class="related-post">
        <div><img src="<?php echo the_post_thumbnail_url( 'featured-thumbnail' ) ?>" alt="<?php esc_attr(the_title()) ?>"></div>
        <div class="related-post-meta"> <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                  </a></div>
        <div class="related-post-meta"><span><?php the_modified_date() ?></span></div> 
        
                 
                  
      </div>
      <?php endwhile;

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

 
function bbj_menu_top() {
  register_nav_menu('my-custom-menu',__( 'Top Menu' ));
}
add_action( 'init', 'bbj_menu_top' );

function boilerplate_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support( 'block-templates' );

  
  add_image_size( 'featured-thumbnail', 400, 200, true ); 
  add_image_size( 'player-banner', 1200, 350, true ); 
  add_image_size ('profile-picture', 200, 200, true);
}

add_action('after_setup_theme', 'boilerplate_add_support');



/*   Season percentage calculator   */

function season_percentage($start, $finish, $evicted){
  $start = new DateTime($start);
  $finish = new DateTime($finish);
  $evicted = new DateTime($evicted);
  $today = new DateTime();

  $evictedDate = $evicted ? $evicted : $today;

  //var_dump($evictedDate);

  //var_dump($evicted);
  $daysIn = $start->diff($evicted)->format('%r%a');
  $diff = $start->diff($finish)->format('%r%a');

  $percentage = $daysIn / $diff;
  $percentage = round((float)$percentage * 100);
 
  return $percentage;
}


/**
 * 
 *
 * Custom Comments
 * 
 */

require_once get_parent_theme_file_path( '/better-comments.php' );



// MailPoet Checkbox to registration
add_action("um_after_profile_fields","um_custom_add_register_form_hook");
function um_custom_add_register_form_hook(){
   do_action( ‘register_form’ );
}