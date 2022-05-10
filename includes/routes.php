<?php 

add_action('rest_api_init', 'bbj_routes');

function bbj_routes() {
  register_rest_route('bbj/v1', 'player_info', array(
    'methods' => 'GET',
    'callback' => 'player_info'
  ));  
}


function player_info($data) {

  global $wpdb; 

  // $sql = 'SELECT ID, profile_picture, first_name, last_name FROM wp_bbj_players AS bbjp';
  // $results = $wpdb->get_results($sql);


  // $newArray = array();

  // foreach ($results as $result):

  //   $imgID = $result->profile_picture;
  //   $sqlTwo = 'SELECT full_name FROM wp_bbj_seasons
  //   WHERE ID = "' . $result->ID . '"';
  //   $resultsTwo = $wpdb->get_results($sqlTwo);
  //   echo '<pre>',print_r($resultsTwo,1),'</pre>';

  //   array_push($newArray, array(
  //     'player_ID'     => $result->ID,
  //     'first_name'    => $result->first_name,
  //     'last_name'     => $result->last_name,
  //     'profile_pic'   => wp_get_attachment_image_url( $imgID, 'thumbnail')
  //   ));
  // endforeach;

  // echo '<pre>',print_r($results,1),'</pre>';


  $mainQuery = new WP_Query(array(
    'post_type' => 'bigbrother-players',
  ));
  
  // $seasonQuery = new WP_Query(array(
  //   'post_type' => 'bigbrother-seasons',

  // ))

  $results = array();
  $season_array = array();

  while($mainQuery->have_posts()) {
     $mainQuery->the_post();

     $seasons = rwmb_meta('bb_seasons_played');
    foreach ($seasons as $season):
      //echo '<pre>',print_r($season,1),'</pre>';
      $sql = 'SELECT full_name FROM wp_bbj_seasons
      WHERE ID = "' . $season['pick_seasons'] . '"';
      $results = $wpdb->get_results($sql);
      array_push($season_array, $results['full_name']);
    endforeach;

    echo '<pre>',print_r($season_array,1),'</pre>';


    array_push($results, array(
      'first_name'    => rwmb_meta('first_name'),
      'last_name'     => rwmb_meta('last_name'),
      'seasons'       => $season_array       
      )
    );    
  }

  //return $mainQuery->posts;
  return $results;

}