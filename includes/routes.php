<?php

add_action("rest_api_init", "bbj_routes");

function bbj_routes()
{
  register_rest_route("bbj/v1", "player_info", [
    "methods" => "GET",
    "callback" => "player_info",
    "permission_callback" => "__return_true",
  ]);



}


function player_info($data)
{
  global $wpdb;
  $sql = "SELECT
  wwbj.first_name, wwbj.last_name, wwbj.profile_picture, wwbj.ID AS playerID, wwbj.date_of_birth, wwbj.player_gender,
  stats.*, seasons.`ID` AS seasonID, seasons.start_date, seasons.end_date, seasons.full_name, geo.locality
  FROM wp_bbj_players AS wwbj
  LEFT JOIN `wp_mb_relationships` 
      ON (wwbj.`ID` = `wp_mb_relationships`.`from`)
  LEFT JOIN wp_bbj_seasons AS seasons
      ON (seasons.`ID` = `wp_mb_relationships`.`to`)
  LEFT JOIN wp_bbj_player_season_stats AS stats 
      ON (stats.`ID` = wwbj.`ID`)
  LEFT JOIN wp_bbj_geo AS geo 
      ON (geo.`ID` = wwbj.`ID`)
  ORDER BY wwbj.first_name ASC; ";

  $players = $wpdb->get_results($sql);

  $playerTable = [];

  foreach ($players as $p):
    $dob = $p->date_of_birth;
    $showStart = $p->start_date;
    $showEnd = $p->end_date;

    $imgUrl = wp_get_attachment_image_src($p->profile_picture, "profile-picture");

    array_push($playerTable, [
      "profile" => $imgUrl[0],
      "first_name" => $p->first_name,
      "last_name" => $p->last_name,
      "player_link" => get_permalink($p->playerID),
      "season" => $p->full_name,
      "hoh_wins" => $p->hohwins ? $p->hohwins : 0,
      "pov_wins" => $p->povwins ? $p->povwins : 0,
      "misc_wins" => $p->miscwins ? $p->miscwins : 0,
      "nom" => $p->nominated ? $p->nominated : 0,
      "saved" => $p->saved_block ? $p->saved_block : 0,
      "finished" => $p->place_finished ? $p->place_finished : "",
      "current_age" => $dob ? current_age($dob) : "",
      "then_age" => $dob ? show_age($dob, $showStart) : "",
      "start_date" => $p->start_date,
      "end_date" => $p->end_date,
      "location" => $p->locality,
      "gender" => $p->player_gender,
    ]);
  endforeach;

  return $playerTable;
}
