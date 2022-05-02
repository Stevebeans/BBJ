<?php 
$currentSeason = rwmb_meta( 'current_season', ['object_type' => 'setting'], 'bbj_settings' );
$players = $wpdb->get_results('SELECT sn.*, s.full_name FROM wp_bbj_player_season_new AS sn
LEFT JOIN wp_bbj_seasons s ON s.ID = sn.ID
	WHERE sn.ID = "' . $currentSeason . '"');
$playerList = unserialize($players[0]->player_list2);
?>


<div class="sideBar">

    <!-- HouseStatus   -->
    <div class="widgetContain">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <?php if (is_user_logged_in()): 
              $currentUser = wp_get_current_user();
              //echo '<pre>',print_r($currentUser,1),'</pre>';
          ?>
          <h2 class="widgetTitle">Welcome Back, Steve</h2>  

          <a href="/user-dashboard">User Dashboard</a>
          <?php else: ?>  
          <h2 class="widgetTitle">Welcome, Visitor!</h2>  
          <?php endif; ?> 
      </div>
      <div class="widgetBody">Here is a small account area that will have some quick links to anything account related. 
        Such items are possibly new posts since last visit, link to edit profile, your comment count, your comment ratio, 
        your membership status (premium, etc)
      </div>
    </div>
  
    <!-- HouseStatus   -->
    <div class="widgetContain">
      <div class="widgetHeader">
        <div class="titleBar"></div>
          <h2 class="widgetTitle">House Status</h2>        
      </div>
      <div class="widgetBody">
        <div class="season-standings">
          <ul>
        <?php 
        foreach($playerList as $player):
          $addInfo = $wpdb->get_results('SELECT profile_picture, first_name, last_name FROM wp_bbj_players WHERE ID = "' . $player['player_id'] . '"');
          $imgUrl =  wp_get_attachment_image_src($addInfo[0]->profile_picture, 'profile-picture');
          // Image Link 
          // echo $imgUrl[0]
        ?>
        <?php //echo '<pre>',print_r($addInfo,1),'</pre>';?>
        
        <?php if ($player['current_hoh']):?>
            <li>HoH - <a href="<?php the_permalink(	$player['player_id']); ?>"><?php echo $addInfo[0]->first_name?></a></li>
        <?php endif ?>
        <?php if ($player['current_pov']):?>
          <li>PoV - <a href="<?php the_permalink(	$player['player_id']); ?>"><?php echo $addInfo[0]->first_name?></a></li>
        <?php endif ?>   
        <?php if ($player['current_nom']):?>
          <li>Nom - <a href="<?php the_permalink(	$player['player_id']); ?>"><?php echo $addInfo[0]->first_name?></a></li>
        <?php endif ?>      
      <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

  </div>