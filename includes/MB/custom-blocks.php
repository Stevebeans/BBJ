<?php

add_filter("rwmb_meta_boxes", function ($meta_boxes) {
  $meta_boxes[] = [
    "title" => "Feed Updates",
    "id" => "feed-updates",
    "description" => "Show the feed updates",
    "type" => "block",
    "icon" => "media-document",
    "category" => "layout",
    "context" => "side",
    "render_template" => get_template_directory() . "/includes/blocks/feed-updates/template.php",
    "enqueue_style" => get_template_directory_uri() . "/includes/blocks/feed-updates/style.css",
    "supports" => [
      "align" => ["wide", "full"],
    ],

    // Block fields.
    "fields" => [
      [
        "name" => "ID",
        "id" => "random_id",
        "type" => "number",
        "label_description" => __("Any 10 digits", "your-text-domain"),
        "size" => 10,
        "required" => true,
      ],
      [
        "type" => "number",
        "id" => "posts_per_page",
        "name" => "Posts Per Page",
        "std" => 25,
      ],
    ],
  ];
  return $meta_boxes;
});
