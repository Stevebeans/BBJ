<?php
get_header();
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
					<div class="seasons">
            
          
          Season Start:<br>
					Season End:<br>
					Days:<br>
					Winner:<br>

          
          
					</div>
					<h3>Players:</h3>

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
                  <div class="standing-contain sc__hoh" style="background-image: url(<?php echo esc_url( $banner ); ?>)">
                    <div class="sc__banner">Head of Household</div>
                    <?php // If winner, show First Place ?>
                  </div>
                  <div class="standing-contain sc__pov" style="background-image: url(<?php echo esc_url( $banner ); ?>)">
                    <div class="sc__banner">Power of Veto</div>
                    <?php // If winner, show Second Place ?>
                  </div>
                  <div class="standing-contain sc__nom">                    
                    <div class="sc__banner">Nominations</div>
										<div class="nom1" style="background-image: url(<?php echo esc_url( $banner ); ?>)"></div>
										<div class="nom2" style="background-image: url(<?php echo esc_url( $banner ); ?>)"></div>
                    <?php // If winner, show Third Place ?>
                  </div>
                </div>
              </div>


					<?php //the_field( 'right_side' ); ?>

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
