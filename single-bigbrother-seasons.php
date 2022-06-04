<?php

use function PHPSTORM_META\map;

get_header();
?>


<?php
$currentSeason = get_the_id();
$players = $wpdb->get_results(
  'SELECT sn.*, s.full_name FROM wp_bbj_player_season_new AS sn
LEFT JOIN wp_bbj_seasons s ON s.ID = sn.ID
	WHERE sn.ID = "' .
    $currentSeason .
    '"'
);

$playerList = unserialize($players[0]->player_list2);
$seasonName = $players[0]->full_name;
?>




<?php
$seasonTable = ["storage_type" => "custom_table", "table" => "wp_bbj_seasons"];

$season_banner = rwmb_meta("season_banner_image", $seasonTable);
$season_profile = rwmb_meta("season_picture", $seasonTable);
?>

<?php if ($season_banner):
  $banner = $season_banner["sizes"]["player-banner"]["url"]; ?>
<div class="player-header" style="background-image: url(<?php echo esc_url($banner); ?>)"></div>
<?php
endif; ?>

 <div class="new-body-container">


	<div class="player-profile">

				<div class="profile-left">
					<div class="player-profile-image">
					<?php if ($season_profile):

       $altText = $season_profile["alt"];
       $profilePicture = $season_profile["sizes"]["profile-picture"]["url"];
       ?>
						<img src="<?php echo esc_url($profilePicture); ?>" alt="<?php echo esc_attr($altText); ?>" />
					<?php
     endif; ?>
					</div>

					<h1 class="player-name-mobile"><?php the_title(); ?></h1>
					<h3>Information:</h3>

					<?php
     $start_date = rwmb_meta("start_date");
     $end_date = rwmb_meta("end_date");
     ?>
					
            
          
          Season Start: <?php echo date("M d, Y", strtotime($start_date)); ?><br>
					Season End:  <?php echo date("M d, Y", strtotime($end_date)); ?><br>
					Days: <?php days_calc($start_date, $end_date); ?><br>

					<h3>Players:</h3>
          
					
					



					<?php //endwhile;

wp_reset_postdata(); ?>


         

					<div class="sideBlock">
						Ad Block 250 wide
					</div>

				</div>
				<div class="profile-right">
					<h1 class="player-name-desktop"><?php the_title(); ?></h1>
				
          <div class="player-profile-content">

							<div class="player-section">
								<div class="players-left"><?php the_content(); ?></div>
								<div class="players-right">
									<h3>Latest Spoilers</h3>
        					<?php get_template_part("template-parts/spoiler-box"); ?>

									<h3>Player List:</h3>
        					<?php get_template_part("template-parts/player-list"); ?>


								</div>
							</div>

              <div class="spoiler-block">
                
              </div>


					

					</div>
				</div>
	</div>


   <div class="mainBody">

		 <?php echo "BEGIN NEWS"; ?>






  </div>
</div>


<?php get_footer();
