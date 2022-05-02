<?php
get_header();
?>


<?php

$currentSeason = get_the_id();
$players = $wpdb->get_results('SELECT sn.*, s.full_name FROM wp_bbj_player_season_new AS sn
LEFT JOIN wp_bbj_seasons s ON s.ID = sn.ID
	WHERE sn.ID = "' . $currentSeason . '"');

$playerList = unserialize($players[0]->player_list2);
$seasonName = $players[0]->full_name;


?>




<?php $seasonTable = ['storage_type' => 'custom_table', 'table' => 'wp_bbj_seasons'];

  $season_banner = rwmb_meta( 'season_banner_image', $seasonTable);
  $season_profile = rwmb_meta( 'season_picture', $seasonTable);
?>

<?php if ( $season_banner ) :
	$banner = $season_banner['sizes']['player-banner']['url']; ?>
<div class="player-header" style="background-image: url(<?php echo esc_url( $banner ); ?>)"></div>
<?php endif; ?>

 <div class="new-body-container">


	<div class="player-profile">

				<div class="profile-left">
					<div class="player-profile-image">
					<?php 
						if ( $season_profile ) :
							$altText = $season_profile['alt'];
							$profilePicture = $season_profile['sizes']['profile-picture']['url']; 
					?>
						<img src="<?php echo esc_url( $profilePicture); ?>" alt="<?php echo esc_attr( $altText ); ?>" />
					<?php endif; ?>
					</div>

					<h1 class="player-name-mobile"><?php the_title() ?></h1>
					<h3>Information:</h3>
					
            
          
          Season Start: <?php echo rwmb_meta('start_date') ?><br>
					Season End:  <?php echo rwmb_meta('end_date') ?><br>
					Days:<br>
					Winner:<br>

					<h3>Players:</h3>
          <div class="seasons">
          
					

					<?php 
					foreach ($playerList as $player):
						$addInfo = $wpdb->get_results('SELECT profile_picture, first_name, last_name FROM wp_bbj_players WHERE ID = "' . $player['player_id'] . '"');
          	$imgUrl =  wp_get_attachment_image_src($addInfo[0]->profile_picture, 'tiny');
          	$firstName = $addInfo[0]->first_name;
						$seasonStart = rwmb_meta('start_date');
						$seasonEnd = rwmb_meta('end_date');
						$evictedDate = $player['evicted'];
						$seasonPercent = season_percentage($seasonStart, $seasonEnd, $evictedDate);
					?>
					<div class="season-container">
						<div class="season"><a href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0]?>" alt=""></a></div>
						<div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $seasonPercent?>"></div>
						</div>
					<?php 
					endforeach;
					wp_reset_postdata();
					?>
</div>
          Player Image Loop with the circle
         

					<div class="sideBlock">
						Ad Block 250 wide
					</div>

				</div>
				<div class="profile-right">
					<h1 class="player-name-desktop"><?php the_title() ?></h1>
				
          <div class="player-profile-content">

              <div class="spoiler-block">
                <h3>Current Results</h3>
                <div class="season-standings">

								<?php 
								foreach($playerList as $player):
									$addInfo = $wpdb->get_results('SELECT profile_picture, first_name, last_name FROM wp_bbj_players WHERE ID = "' . $player['player_id'] . '"');
									$imgUrl =  wp_get_attachment_image_src($addInfo[0]->profile_picture, 'profile-picture');

					

								//	echo '<pre>',print_r($player,1),'</pre>';
									if ($player['current_winner']):
								?>
                  <div class="standing-contain sc__hoh">
                    <div class="sc__banner">Winner</div>
										<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
                  </div>
								<?php	
									endif;
									if ($player['current_second']):
								?>
                  <div class="standing-contain sc__pov">
                    <div class="sc__banner">Second</div>
										<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
                  </div>
								<?php 
									endif;
									if ($player['current_afp']):
										?>
											<div class="standing-contain sc__pov">
												<div class="sc__banner">America's Favorite</div>
												<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
											</div>
										<?php 
									endif;
									if ($player['current_hoh']):
										?>
											<div class="standing-contain sc__pov">
												<div class="sc__banner">Head of Household</div>
												<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
											</div>
										<?php 
									endif;
									
									if ($player['current_pov']):
										?>
											<div class="standing-contain sc__pov">
												<div class="sc__banner">Power of Veto</div>
												<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
											</div>
										<?php 
									endif;

									
									if ($player['current_nom']):
										?>
											<div class="standing-contain sc__pov">
												<div class="sc__banner">Nomination</div>
												<div><A href="<?php the_permalink(	$player['player_id']); ?>"><img src="<?php echo $imgUrl[0] ?>" alt=""></a></div>                    
											</div>
										<?php 
									endif;
								endforeach;
								?>


                </div>
              </div>


					<?php the_content(); ?>

					</div>
				</div>
	</div>


   <div class="mainBody">

		 <?php 	
		 
		 echo 'BEGIN NEWS';
?>






  </div>
</div>


<?php
get_footer();
