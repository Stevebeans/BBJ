    <?php 

      $currentSeason = rwmb_meta( 'current_season', ['object_type' => 'setting'], 'bbj_settings' );
      $players = $wpdb->get_results('SELECT sn.*, s.full_name FROM wp_bbj_player_season_new AS sn
      LEFT JOIN wp_bbj_seasons s ON s.ID = sn.ID
        WHERE sn.ID = "' . $currentSeason . '"');

      $playerList = unserialize($players[0]->player_list2);
      $seasonName = $players[0]->full_name;

    ?>
    
    <div class="spoilerBar">
      <div class="playerDiv">

      <?php       
        foreach($playerList as $player):
          $addInfo = $wpdb->get_results('SELECT profile_picture, first_name, last_name FROM wp_bbj_players WHERE ID = "' . $player['player_id'] . '"');
          $imgUrl =  wp_get_attachment_image_src($addInfo[0]->profile_picture, 'profile-picture');
          $firstName = $addInfo[0]->first_name;
      ?>      
          <?php $status = '';
            switch (true) {
              case ($player['current_hoh']):
                $status = 'HoH';
                break;              
              case ($player['current_pov']):
                $status = 'PoV';
                break;          
              case ($player['current_nom']):
                $status = 'Nom';
                break;   
              case ($player['current_jury']):
                $status = 'Jury';
                break;         
              case ($player['current_evic']):
                $status = 'Evicted';
                break;
              case ($player['current_winner']):
                $status = 'Winner';
                break;  
              case ($player['current_second']):
                $status = 'Second';
                break;
              case ($player['current_afp']):
                $status = 'AFP';
                break;              
            }
          ?>
          <div class="profile-contain">
            <div class="header-thumb <?php echo $status ?>"><a href="<?php the_permalink($player['player_id'])?>"><img src="<?php echo $imgUrl[0] ?>" alt="Player profile for <?php echo $seasonName . ' - ' . $firstName . ' ' . $addInfo[0]->last_name?>"></a></div>
            <div>
              <h3><?php echo $firstName ?></h3>
              <h4 class="<?php echo $status ?>"><?php echo $status?></h4>
            </div>
          </div>
      <?php endforeach; ?>

      </div>
      <div class="closingBar"></div>
    </div>