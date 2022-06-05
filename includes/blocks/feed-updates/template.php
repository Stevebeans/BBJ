<?php

if (empty($attributes["data"])) {
  return;
}

// Unique HTML ID if available.
$id = "hero-" . ($attributes["id"] ?? "");
if (!empty($attributes["anchor"])) {
  $id = $attributes["anchor"];
}

$postsPerPage = mb_get_block_field("posts_per_page");

$ajaxCode = '[ajax_load_more id="1890809383" container_type="div" css_classes="update-post" cache="true" cache_id="9130117963" filters="true" preloaded="true" preloaded_amount="20" seo="true" post_type="live-feed-updates,bigbrother-players" posts_per_page="10" destroy_after="200" no_results_text="No updates yet, check back shortly!" cta="true" cta_position="after:5" cta_theme_repeater="adsense-feed-updates.php" theme_repeater="feed-updates.php"]';
?>

<?= do_shortcode($ajaxCode) ?>
