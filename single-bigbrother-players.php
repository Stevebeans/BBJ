<?php
get_header();
?>


<?php 

	$playerID = get_the_id();

	$playerTableInfo = ['storage_type' => 'custom_table', 'table' => 'wp_bbj_players'];
	$playerSeasonInfo = ['storage_type' => 'custom_table', 'table' => 'wp_bbj_player_results'];

	$player_banner = rwmb_meta( 'player_banner', $playerTableInfo);
	$player_profile = rwmb_meta( 'profile_picture', $playerTableInfo);
	$fbLink = rwmb_meta( 'facebook', $playerTableInfo);
	$igLink = rwmb_meta( 'instagram', $playerTableInfo);
	$twLink = rwmb_meta( 'twitter', $playerTableInfo);
	$ttLink = rwmb_meta( 'tiktok', $playerTableInfo);
	$rightSide = rwmb_meta( 'right_side', $playerTableInfo);




?>
<?php if ( $player_banner ) :
	$banner = $player_banner['sizes']['player-banner']['url']; ?>
<div class="player-header" style="background-image: url(<?php echo esc_url( $banner ); ?>)"></div>
<?php endif; ?>

 <div class="new-body-container">


	<div class="player-profile">

				<div class="profile-left">
					<div class="player-profile-image">
					<?php 
						// $main_photo = get_field( 'profile_picture' );?>
					<?php 
						if ( $player_profile ) :
							$altText = $player_profile['alt'];
							$profilePicture = $player_profile['sizes']['profile-picture']['url']; 
					?>
						<img src="<?php echo esc_url( $profilePicture); ?>" alt="<?php echo esc_attr( $altText ); ?>" />
					<?php endif; ?>
					</div>

					<h1 class="player-name-mobile"><?php   the_title() ?></h1>
					<h3>Seasons:</h3>
					<div class="seasons">


            
<?php 

							
						$newInfo = rwmb_meta( 'bb_seasons_played', ['storage_type' => 'custom_table', 'table' => 'wp_bbj_player_results_new']);
						foreach ($newInfo as $n):

						$evicted = $n['evicted_date'];
						$season = $n['pick_seasons'];
						

						$sql = 'SELECT s.ID, s.start_date, s.end_date, s.season_number
            FROM wp_bbj_seasons AS s
            WHERE s.ID = "' . $season . '"';
          	$seasons = $wpdb->get_results($sql);
						
						$seasonStart = $seasons[0]->start_date;
						$seasonEnd = $seasons[0]->end_date;
						$evictedDate = $n['evicted_date'];

						$seasonPercent = season_percentage($seasonStart, $seasonEnd, $evictedDate);
								
						?>
						
						
						<div class="season-container">
						<div class="season"><a href="<?php the_permalink(	$season); ?>"><?php echo esc_html($seasons[0]->season_number) ?></a></div>
						<div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $seasonPercent?>"></div>
						</div>

						<?php 
						endforeach;
							

								//$evictedDate = get_field('evicted_date2');
							//echo 'evicted Date -';
							//echo $evictedDate;
							//echo '<pre>',print_r($evictedDate,1),'</pre>';
								//season_percentage($seasonStart, $seasonEnd, $evictedDate) 

						//echo '<pre>',print_r($connected,1),'</pre>';
						// while ( $connected->have_posts() ) : $connected->the_post();
						// the_title(); 
						// endwhile;
						wp_reset_postdata();

?>


          
					</div>
					<h3>Info:</h3>
          (needed fields)..<br>
          Date of birth (show age)<br>
          Hometown<Br>
          Occupation<br>
          Days in house<br>
          <b>Official Social Media</b><br>
					<div class="player-socials">
						         
          <?php if ($fbLink): ?>
						<div><a href="<?php $fbLink ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/facebook.png' ?>" alt="facebook"></a></div>
          <?php endif; ?>
          <?php if ($igLink): ?>
						<div><a href="<?php $igLink ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/instagram.png' ?>" alt="Instagram"></a></div>
          <?php endif; ?>
					
          <?php if ($twLink): ?>
						<div><a href="<?php $twLink ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/twitter.png' ?>" alt="twitter"></a></div>
          <?php endif; ?>
					
          <?php if ($ttLink): ?>
						<div><a href="<?php $ttLink ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/tiktok.png' ?>" alt="tiktok"></a></div>
          <?php endif; ?>
					</div>

					<div class="sideBlock">
						Ad Block 250 wide
					</div>

				</div>
				<div class="profile-right">
					<h1 class="player-name-desktop"><?php  the_title() ?></h1>
				
          <div class="player-profile-content">


					<?php echo $rightSide ?>

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
