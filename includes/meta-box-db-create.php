<?php

add_action( 'init', 'prefix_create_table' );
function prefix_create_table() {
  if ( ! class_exists( 'MB_Custom_Table_API' ) ) {
    return;
  }

  MB_Custom_Table_API::create( 'wp_bbj_player_season_results', array(
    'player_id'       => 'BIGINT(20) NOT NULL',
    'current_hoh'     => 'TINYINT NOT NULL',
    'current_pov'     => 'TINYINT NOT NULL',
    'current_jury'    => 'TINYINT NOT NULL',
    'current_nom'     => 'TINYINT NOT NULL',
    'current_evic'    => 'TINYINT NOT NULL',
    'current_winner'  => 'TINYINT NOT NULL',
    'current_second'  => 'TINYINT NOT NULL',
    'current_afp'     => 'TINYINT NOT NULL',   
    'evicted'         => 'DATE NOT NULL',
  ));
}