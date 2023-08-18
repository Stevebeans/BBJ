
<div class="w-full md:w-80 p-2">

  <?php get_template_part("template-parts/socials"); ?>


  <?php get_template_part("template-parts/sidebar-newsletter"); ?>


  <?php sidebar_ad() ?>


  <h3 class="font-mainHead text-2xl text-primary500 mt-6">Big Brother Stats</h3>
        <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>
      
        

        <?= do_shortcode("[bbj_stats]") ?>

        <div class="text-xs">More stats to come!</div>

</div>