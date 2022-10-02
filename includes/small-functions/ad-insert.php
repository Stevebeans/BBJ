<?php
//Insert ads after second paragraph of single post content.

add_filter("the_content", "prefix_insert_post_ads");

function prefix_insert_post_ads($content)
{
  if (!premiumCheck()):
    $first_ad_code = adinserter(3);
  endif;

  if (!premiumCheck()):
    $second_ad_code = adinserter(4);
  endif;

  $third_ad_code = $first_ad_code;
  $fourth_ad_code = $first_ad_code;

  if (is_single() && "live-feed-updates" != get_post_type()) {
    $content = prefix_insert_after_paragraph($first_ad_code, 1, $content);
    $content = prefix_insert_after_paragraph($second_ad_code, 3, $content);
    $content = prefix_insert_after_paragraph($third_ad_code, 7, $content);
    $content = prefix_insert_after_paragraph($fourth_ad_code, 11, $content);
    return $content;
  }
  return $content;
}

// Parent Function that makes the magic happen

function prefix_insert_after_paragraph($insertion, $paragraph_id, $content)
{
  $closing_p = "</p>";
  $paragraphs = explode($closing_p, $content);
  foreach ($paragraphs as $index => $paragraph) {
    if (trim($paragraph)) {
      $paragraphs[$index] .= $closing_p;
    }

    if ($paragraph_id == $index + 1) {
      $paragraphs[$index] .= $insertion;
    }
  }

  return implode("", $paragraphs);
}
