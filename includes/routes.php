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
  p.ID AS playerID,
  p.first_name,
  p.last_name,
  p.profile_picture,
  p.date_of_birth,
  p.player_gender,
  p.official_nickname,
  psr.winner,
  psr.afp,
  psr.runner_up,
  psr.total_hoh,
  psr.total_pov,
  psr.total_nom,
  psr.season_id,
  s.full_name AS season_name,
  s.start_date AS season_start,
  s.abbreviation AS season_abbr,
  s.end_date AS season_end
  FROM wp_bbj_players AS p
  LEFT JOIN wp_bbj_play_season_rel AS psr ON psr.player_id = p.ID
  LEFT JOIN wp_bbj_seasons as s ON s.ID = psr.season_id
  ";

  $players = $wpdb->get_results($sql);

  $playerTable = [];
  $addedPlayerIDs = [];

  foreach ($players as $p):
    $dob = $p->date_of_birth;
    $city = rwmb_meta("locality", "", $p->playerID);
    $imgUrl = wp_get_attachment_image_src($p->profile_picture, "profile-picture");
    $seasonLink = get_permalink($p->season_id);

    $playerID = $p->playerID;

    if (!in_array($playerID, $addedPlayerIDs)) {
      $addedPlayerIDs[] = $playerID;
      $playerTable[] = [
        "id" => $playerID,
        "profile" => $imgUrl[0],
        "first_name" => $p->first_name,
        "last_name" => $p->last_name,
        "nickname" => $p->official_nickname,
        "player_link" => get_permalink($playerID),
        "location" => $city,
        "gender" => $p->player_gender,
        "current_age" => $dob ? current_age($dob) : "",
        "seasons" => [],
      ];
    }

    if ($p->season_id) {
      $playerIndex = array_search($playerID, $addedPlayerIDs);
      $playerTable[$playerIndex]["seasons"][$p->season_id] = [
        "name" => $p->season_name,
        "abbr" => $p->season_abbr,
        "link" => $seasonLink,
        "winner" => $p->winner,
        "runner_up" => $p->runner_up,
        "afp" => $p->afp,
        "start_date" => $p->season_start,
        "end_date" => $p->season_end,
        "hoh_wins" => $p->total_hoh ? $p->total_hoh : 0,
        "pov_wins" => $p->total_pov ? $p->total_pov : 0,
        "nom" => $p->total_nom ? $p->total_nom : 0,
      ];
    }
  endforeach;

  return $playerTable;
}

