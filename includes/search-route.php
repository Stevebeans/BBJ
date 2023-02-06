<?php

add_action("rest_api_init", function () {
  register_rest_route("bbj/v1", "/search", [
    "methods" => "GET",
    "callback" => "bbj_search_results",
  ]);
});

function bbj_search_results($request)
{
  $search_query = $request->get_param("query");

  $args = [
    "post_type" => ["post", "page", "bigbrother-players", "bigbrother-seasons"],
    "s" => $search_query,
    "posts_per_page" => 10,
  ];
  $results = [
    "general" => [],
    "players" => [],
    "seasons" => [],
  ];

  $query = new WP_Query($args);

  while ($query->have_posts()):
    $query->the_post();

    if (get_post_type() == "post" || get_post_type() == "page") {
      array_push($results["general"], [
        "title" => get_the_title(),
        "permalink" => get_the_permalink(),
      ]);
    }

    if (get_post_type() == "bigbrother-players") {
      array_push($results["players"], [
        "title" => get_the_title(),
        "permalink" => get_the_permalink(),
      ]);
    }

    if (get_post_type() == "bigbrother-seasons") {
      array_push($results["seasons"], [
        "title" => get_the_title(),
        "permalink" => get_the_permalink(),
      ]);
    }
  endwhile;

  return $results;
}
