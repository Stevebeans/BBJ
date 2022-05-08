<?php 

add_action('rest_api_init', 'bbj_routes');

function bbj_routes() {
  register_rest_route('bbj/v1', 'player_info', array(
    'methods' => 'GET',
    'callback' => 'player_info'
  ));  
}


function player_info($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('bigbrother-players'),
  ));

  $results = array(
    'players' => array()
  );

  while($mainQuery->have_posts()) {
     $mainQuery->the_post();
    array_push($results['players'], array(
      'First_Name'    => rwmb_meta('first_name'),
      'Last_Name'     => rwmb_meta('last_name')
    ));
  }

  $newResults = json_encode($results);

  echo  $newResults;

}