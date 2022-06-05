
<?php
global $post;
$get_author_id = $post->post_author;
?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
  <div class="feed-update-post">
    <div class="avatar">
    <img src="<?php echo esc_url(get_avatar_url($get_author_id, ["size" => 15])); ?>" class="avatar-img"/>
    </div>
    <div class="header"><h3><?php the_title(); ?></h3></div>
    <div class="date"><?php the_modified_date(); ?></div>
    <div class="body">
    <?php if (has_post_thumbnail()):
      $thumb = the_post_thumbnail($size = "profile-picture");
      echo "<pre>", print_r($thumb, 1), "</pre>";
    endif; ?>  
    <?php the_excerpt(); ?></div>
  </div>
</a>
