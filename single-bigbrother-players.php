<?php
get_header(); ?>




<?php get_header(); ?>

<div class="bbj-container-inner">

<?php
//get all the fields
$playerName = get_the_title(get_the_ID());
$image = rwmb_meta("profile_picture");
$banner = rwmb_meta("player_banner", ["size" => "player-banner"]);
$dob = rwmb_meta("date_of_birth");
$gender = rwmb_meta("player_gender");
$city = rwmb_meta("locality");
$state = rwmb_meta("administrative_area_level_1");
$job = rwmb_meta("occupation");
$evicted = rwmb_meta("evicted_date");
$fbLink = rwmb_meta("facebook");
$igLink = rwmb_meta("instagram");
$twLink = rwmb_meta("twitter");
$ttLink = rwmb_meta("tiktok");
$playerID = get_the_id();
?>


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      
    
      <div class="flex flex-col md:flex-row">



				<div class="w-full border-2 border-second500 p-2 bg-sky-100 lg:w-[250px]  shrink-0">	
						

						
						
					<div class="flex-cnt">


						
						<div class="mt-[-40px] flex-cnt relative h-40 w-40">
						
						<?php if (!empty($image)): ?>
						<div class="absolute top-0 left-0 h-40 w-40">
						<img src="<?= esc_url($image["url"]) ?>" alt="Profile Picture" class=" rounded-full">
						</div>
						
							<div class="h-40 w-40 absolute top-0 left-0">
							<svg viewBox="0 0 100 100" class="circle">
  							<circle cx="50" cy="50" r="48" fill="transparent" stroke-width="4" stroke="#FFBF0F"/>
  							<circle cx="50" cy="50" r="48" fill="transparent" stroke-width="4" stroke="gray" id="bar"/>
							</svg>
							</div>
						<?php endif; ?>	
						</div>

        			
       			
					</div>
					<h1 class="font-mainHead text-xl font-bold text-primary500 dark:font-normal dark:text-gray-300 border-b mb-2 border-primary500"><?= $playerName ?></h1>

					<div><span class="text-gray-600 font-osw">Information:</span></div>
								
					
	<?php
 $connected = new WP_Query([
   "relationship" => [
     "id" => "player-to-season",
     "from" => get_the_ID(),
   ],
   "nopaging" => true,
 ]);
 if ($connected->have_posts()):

   $connected->the_post();

   $seasonID = get_the_ID();
   $seasonAb = rwmb_meta("abbreviation");
   $start_date = rwmb_meta("start_date");
   $end_date = rwmb_meta("end_date");

   $seasonPercent = season_percentage($start_date, $end_date, $evicted);
   ?>


					<div class="grid grid-cols-[35%_65%] items-center">
						<div class="text-sm">Season</div>
						<div class="font-osw font-semibold text-primary500 underline"><a href="<?= get_permalink($seasonID) ?>"><?= $seasonAb ?></a>
						</div>
						<div class="text-sm">Gender</div>	
						<div class="font-osw font-semibold text-primary500"><?= $gender ?></div>
						<div class="text-sm">Age <span class="text-xs">(then)</span></div>	
						<div class="font-osw font-semibold text-primary500"><?= show_age($dob, $start_date) ?></div>						
						<div class="text-sm">Age <span class="text-xs">(now)</span></div>	
						<div  class="font-osw font-semibold text-primary500"><?= current_age($dob) ?></div>						
						<div class="text-sm">City</div>	
						<div class="font-osw font-semibold text-primary500"><?= $city ?></div>
						<div class="text-sm">State</div>	
						<div class="font-osw font-semibold text-primary500"><?= $state ?></div>
						<div class="text-sm">Job</div>	
						<div class="font-osw font-semibold text-primary500"><?= $job ?></div>

					</div>

					<div class="my-2"><span class="text-gray-600 font-osw">Season Progression:</span> <span class="font-osw font-semibold text-second500"><?php echo $seasonPercent; ?>%</span> <span class="text-xs">(<?php days_calc($start_date, $evicted); ?> Days)</span> </div>
					
					<div class="flex"><span class="text-gray-600 font-osw mr-2">Socials:</span>
					
					<?php if ($fbLink): ?>
						<div class="mr-2 "><a href="<?php echo $fbLink; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></div>
          <?php endif; ?>
          <?php if ($igLink): ?>
						<div class="mr-2"><a href="<?php echo $igLink; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></div>
          <?php endif; ?>
					
          <?php if ($twLink): ?>
						<div class="mr-2"><a href="<?php echo $twLink; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></div>
          <?php endif; ?>
					
          <?php if ($ttLink): ?>
						<div><a href="<?php echo $ttLink; ?>" target="_blank"><i class="fa-brands fa-tiktok"></i></a></div>
          <?php endif; ?></div>




<script>
const bar = document.querySelector('#bar');
const svg = document.querySelector('.circle');
const circumference = 2 * Math.PI * 45;
const percent = <?php echo $seasonPercent; ?>;
bar.style.strokeDasharray = `${circumference * percent / 100} ${circumference}`;
bar.style.strokeDashoffset = circumference;
svg.style.transform = "rotate(-90deg)";




</script>
					<?php
 endif;
 wp_reset_postdata();
 ?>

 					<div class="mt-4"><a href="/player-directory/">View Player Directory</a></div>
				</div>

				
				<div class="grow">
						<?php if (!empty($banner)): ?>
						<div class="w-full">
						<img src="<?= esc_url($banner["url"]) ?>" alt="Profile Picture" class="w-full rounded-br-2xl border-t-4 border-second500">
						</div>
						<?php endif; ?>
							<div class="p-2">
								<div class="text-gray-600 font-osw">Biography and more:</div>
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
