<?php get_header(); ?>

<div class="bbj-container-inner">


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
      <div class="heading-bg">
        <h1 class="heading-text"><a href="<?= site_url() ?>" class="hover:text-primarySoft">Home</a> >> Big Brother Player Directory</h1>
      </div>
    
      <div id="player-directory-table">
        <div class="bbj-player-card-container group">
          <div class="w-full flex">
            <div class="w-40 h-28"><img src="http://bbj3.local/wp-content/uploads/2022/04/alyssa-big-brother-1625794980523-2-200x200.png" class="w-40 h-full" alt=""></div>
            <div class="py-1 px-2 flex flex-col justify-between w-full">
              <div>
                <h3 class="font-ibm text-primary500 text-sm group-hover:text-secondHard ">Alyssa</h3>
                <h2 class="font-ibm text-primary500 text-base leading-4 group-hover:text-secondHard font-semibold">Lopez</h2>
                <h4 class="font-ibm text-xs">Big Brother 23</h4>
              </div>
              
              <div class="grid grid-cols-2 text-xs text-primary500 align-bottom  mt-2" style="grid-template-columns: 0.7fr 1.3fr">
                <div class="w-1/4">Age</div>
                <div class="group-hover:text-secondHard">23</div>

                <div>Loc</div>
                <div class="group-hover:text-secondHard">Los Angelas</div>
              </div>
            </div>
          </div>
          <div class="px-2 py-1">
            <div class="rounded-xl  overflow-hidden">

              <div class="bg-primary500 text-center text-white">Season Stats</div>
              <div class="bg-slate-300 grid grid-cols-4 justify-around gap-1 p-1">
                <div class="player-card-stat-header">HOH</div>
                <div class="player-card-stat-header">POV</div>
                <div class="player-card-stat-header">NOM</div>
                <div class="player-card-stat-header">SAVED</div>

                <div class="group-hover:text-secondHard text-xs text-center">1</div>
                <div class="group-hover:text-secondHard text-xs text-center">1</div>
                <div class="group-hover:text-secondHard text-xs text-center">1</div>
                <div class="group-hover:text-secondHard text-xs text-center">1</div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div>
        <?php get_template_part("template-parts/sidebar-default"); ?>
    </div>
  </div>




</div>


<?php get_footer(); ?>
