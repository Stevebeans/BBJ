<?php
function get_new_posts($request)
{
  // Retrieve the last visit timestamp from the request parameters
  $last_visit = $request->get_param("last_visit");

  // Query the database for new posts
  $args = [
    "post_type" => "live-feed-updates",
    "post_status" => "publish",
    "date_query" => [
      [
        "after" => date("Y-m-d H:i:s", $last_visit / 1000),
      ],
    ],
  ];
  $query = new WP_Query($args);

  // Return the results as a JSON object
  $response = [
    "posts" => $query->posts,
  ];
  return new WP_REST_Response($response, 200);
}

function register_new_posts_endpoint()
{
  register_rest_route("bbj/v1", "/new-posts", [
    "methods" => "GET",
    "callback" => "get_new_posts",
  ]);
}
add_action("rest_api_init", "register_new_posts_endpoint");
