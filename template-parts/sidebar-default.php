
<div class="w-full md:w-80 p-2">

  <?php get_template_part("template-parts/socials"); ?>


  <?php get_template_part("template-parts/sidebar-newsletter"); ?>

  <?php if (!premiumCheck()):
    get_template_part("template-parts/ads/ad-rectangle");

    // get_template_part("template-parts/ads/taboola-sidebar");
  endif; ?>
</div>