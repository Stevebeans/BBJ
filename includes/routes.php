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

  $mainQuery = new WP_Query(array(
    'posts_per_page'  => -1,
    'post_type' => 'bigbrother-players',
    ));
    
  $results = array();
  $season_array = array();
  $full_array = array();
  $player = array();

  while($mainQuery->have_posts()):
    $mainQuery->the_post();
    $seasons = rwmb_meta('bb_seasons_played');
    unset( $played_seasons );
    $player_id = get_the_ID();
    $first_name = rwmb_meta('first_name');
    $last_name = rwmb_meta('last_name');


    foreach ($seasons as $season): 
      $season_id = $season[ 'pick_seasons' ];

      $sql = 'SELECT full_name FROM wp_bbj_seasons
      WHERE ID = "'. $season['pick_seasons'] . '"';
      $results = $wpdb->get_results($sql);

      $played_seasons[ $season_id ] = $results[0]->full_name;
      $hoh_wins[ $season_id ] = $season[ 'hoh_wins'];
      $pov_wins[ $season_id ] = $season[ 'pov_wins'];
      
    endforeach;  
    
    //Push into array
    array_push($player, array(
      'first_name'    => $first_name,
      'last_name'     => $last_name,
      'seasons'       => $played_seasons,
      'hoh_wins'      => $hoh_wins,
      'pov_wins'      => $pov_wins
    ));
      // $player[ $player_id ][ 'first_name' ] = $first_name;
		  // $player[ $player_id ][ 'last_name' ] = $last_name;
		  // $player[ $player_id ][ 'seasons_played' ] = $played_seasons;
      // $player[ $player_id ][ 'hoh_wins'] = $hoh_wins;
      // $player[ $player_id ][ 'pov_wins'] = $pov_wins;


  endwhile;


  return $player;

}