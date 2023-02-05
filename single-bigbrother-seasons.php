<?php

use function PHPSTORM_META\map;

get_header();
?>



<div class="bbj-container-inner">

<?php
//get all the fields
$playerName = get_the_title(get_the_ID());
$image = rwmb_meta("season_picture");

$banner = rwmb_meta("season_banner_image", ["size" => "player-banner"]);
$start_date = rwmb_meta("start_date");
$end_date = rwmb_meta("end_date");
$abbrv = rwmb_meta("abbreviation");
$seasonNum = rwmb_meta("season_number");
$seasonID = get_the_id();
?>


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      
    
      <div class="flex flex-col md:flex-row">



				<div class="w-full border-2 border-second500 p-2 bg-sky-100 lg:w-[250px] shrink-0">	
						

						
						
					<div class="flex-cnt">


						
						<div class="mt-[-40px] flex-cnt relative h-40 w-40">
						
						<?php if (!empty($image)): ?>
						<div class="absolute top-0 left-0 h-40 w-40">
						<img src="<?= esc_url($image["url"]) ?>" alt="Profile Picture" class="border-2 border-second500 rounded-full">
						</div>
						
						<?php endif; ?>	
						</div>

        			
       			
					</div>
					<h1 class="font-mainHead text-xl font-bold text-primary500 dark:font-normal dark:text-gray-300 border-b mb-2 border-primary500"><?= $playerName ?></h1>

					<div><span class="text-gray-600 font-osw">Information:</span></div>


					<div class="grid grid-cols-[35%_65%] items-center">
						<div class="text-sm">Start</div>
						<div class="font-osw font-semibold text-primary500"><?= date("m/d/Y", strtotime($start_date)) ?></div>
						<div class="text-sm">End</div>	
						<div class="font-osw font-semibold text-primary500"><?= date("m/d/Y", strtotime($end_date)) ?></div>
						<div class="text-sm">Total:</div>	
						<div class="font-osw font-semibold text-primary500"><?= days_calc($start_date, $end_date) ?> days</div>		

					</div>
								
					
					<?php wp_reset_postdata(); ?>

				</div>

				
				<div class="grow">
						<?php if (!empty($banner)): ?>
						<div class="w-full">
						<img src="<?= esc_url($banner["url"]) ?>" alt="Profile Picture" class="w-full rounded-br-2xl border-t-4 border-second500">
						</div>
						<?php endif; ?>
							<div class="p-2">
								<div class="text-gray-600 font-osw ">Houseguests:</div>

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

        $seasonTable = ["storage_type" => "custom_table", "table" => "wp_bbj_seasons"];

        $season_banner = rwmb_meta("season_banner_image", $seasonTable);
        $season_profile = rwmb_meta("season_picture", $seasonTable);

        //echo "<pre>", print_r($playerList, 1), "</pre>";

        $connected = new WP_Query([
          "relationship" => [
            "id" => "player-to-season",
            "to" => get_the_ID(),
          ],
          "nopaging" => true,
        ]);
        ?>

								<div class="flex flex-wrap">
									<?php while ($connected->have_posts()):

           $connected->the_post();

           $firstName = rwmb_meta("first_name");
           $lastName = rwmb_meta("last_name");
           $city = rwmb_meta("locality");
           $playerID = get_the_ID();

           $dob = rwmb_meta("date_of_birth");
           $image = rwmb_meta("profile_picture", ["size" => "profile-picture"]);
           ?>	


									<div class="bg-slate-100 w-full mb-4 shadow-deep relative md:w-[300px] md:mr-4"> 
										<div class="absolute px-2 py-1 top-[-10px] right-[-10px] bg-white rounded-full border-4 border-primary500 text-primary500 font-osw"><?= show_age_sm($dob, $start_date) ?></div>
										<div class="flex">
												<div><img src="<?= esc_url($image["url"]) ?>" class="rounded-br-3xl h-16 w-16" alt=""></div>
												<div class="font-osw text-primary500 pl-2 pr-2">
													<div><?= esc_html($firstName) ?> <?= esc_html($lastName) ?></div>
													<div><?= esc_html($city) ?></div>
												</div>
										</div>
										<a href="<?= get_permalink($playerID) ?>"><div class="text-center py-1 bg-second500 text-xs hover:text-primarySoft">View Player Profile</div></a>
										
									</div>

									<?php
         endwhile; ?>

								</div>
								<div class="text-center text-xl font-bold"><a href="/all-seasons/">View All Seasons Here</a></div>
								<div><?php the_content(); ?></div>
							</div>
				</div>
				<div class=" shrink-0">
						<?php get_template_part("template-parts/sidebar-default"); ?>
				</div>
			</div>

    </div>

  </div>




</div>










<?php get_footer();
