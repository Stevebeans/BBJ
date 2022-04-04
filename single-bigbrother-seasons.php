<?php
get_header();
?>

<?php $player_banner = get_field( 'season_banner' ); ?>
<?php if ( $player_banner ) : ?>
<div class="player-header" style="background-image: url(<?php echo esc_url( $player_banner['url'] ); ?>)"></div>
<?php endif; ?>

 <div class="new-body-container">


	<div class="player-profile">

				<div class="profile-left">
					<div class="player-profile-image">
					<?php 
						$main_photo = get_field( 'season_picture' );?>
					<?php 
						if ( $main_photo ) :
							$url = $main_photo['url'];
							$alt = $main_photo['alt'];
							$thumb = $main_photo['sizes']['season_picture']; 
					?>
						<img src="<?php echo esc_url( $thumb); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
					<?php endif; ?>
					</div>

					<h1 class="player-name-mobile"><?php the_field( 'acf_bb_season' ); ?></h1>
					<h3>Seasonsafdsds:</h3>
					<div class="seasons">
            
          
          <?php if ( have_rows( 'season' ) ) : ?>
            <?php while ( have_rows( 'season' ) ) : the_row(); ?>
              <?php $bb_season = get_sub_field( 'bb_season' ); ?>
              <?php if ( $bb_season ) : ?>
                <?php foreach ( $bb_season as $post ) : ?>
                  <?php setup_postdata ( $post ); ?>              

                  <?php
										$seasonStart = get_field('start_date');
										$seasonEnd = get_field('end_date');
										$evictedDate = get_sub_field('evicted_date');
										//echo '<pre>',print_r($evictedDate,1),'</pre>';
										$seasonPercent =	season_percentage($seasonStart, $seasonEnd, $evictedDate) 
                      
                  ?>
                  
                  
								<div class="season-container">
									<div class="season"><a href="<?php the_permalink(); ?>"><?php the_field('season_number'); ?></a></div>
									<div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $seasonPercent?>"></div>
								</div>
                  
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php else : ?>
            <?php // No rows found ?>
          <?php endif; ?>
          
          
					</div>
					<h3>Players:</h3>

          <?php 
          global $wpdb;
          $seasonID = get_the_ID();

          $sql = 'SELECT evic.*, pn.*, a.player_season_relationship AS playerID, a.post_ID AS seasonID
            FROM wp_acf2_relationships__player_season_relationship AS a
            LEFT JOIN wp_acf_bbplayer AS pn ON pn.post_ID = a.player_season_relationship
            LEFT JOIN wp_acf_bbplayer__season AS evic ON a.post_ID = evic.bb_season
            WHERE a.post_ID = "' . $seasonID . '"';



          $seasonPlayers = $wpdb->get_results($sql);
          ?>
          


          
          <?php wp_reset_postdata(); ?>




          
          <?php $players = get_field( 'players' ); ?>
          <?php if ( $players ) : ?>
            <?php foreach ( $players as $post ) : ?>
              <?php setup_postdata ( $post ); ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              <?php echo 'new stuff below'?>
              <?php get_sub_field('player_name')?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>


          (needed fields)..<br>
          Date of birth (show age)<br>
          Hometown<Br>
          Occupation<br>
          Days in house<br>
          <b>Official Social Media</b><br>
					<div class="player-socials">
						         
          <?php if (get_field('facebook')): ?>
						<div><a href="<?php the_field( 'facebook' ); ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/facebook.png' ?>" alt="facebook"></a></div>
          <?php endif; ?>
          <?php if (get_field('instagram')): ?>
						<div><a href="<?php the_field( 'instagram' ); ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/instagram.png' ?>" alt="Instagram"></a></div>
          <?php endif; ?>
					
          <?php if (get_field('twitter')): ?>
						<div><a href="<?php the_field( 'twitter' ); ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/twitter.png' ?>" alt="twitter"></a></div>
          <?php endif; ?>
					
          <?php if (get_field('tiktok')): ?>
						<div><a href="<?php the_field( 'tiktok' ); ?>" target="_blank"><img src="<?php echo BBJ_THEME_PATH . 'images/tiktok.png' ?>" alt="tiktok"></a></div>
          <?php endif; ?>
					</div>

					<div class="sideBlock">
						Ad Block 250 wide
					</div>

				</div>
				<div class="profile-right">
					<h1 class="player-name-desktop"><?php the_field( 'acf_bb_season' ); ?></h1>
				
          <div class="player-profile-content">


					<?php the_field( 'right_side' ); ?>

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
