
<div>

  <div class="border border-gray-200 rounded-md p-2 m-4">

  Socials

  </div>


  <div class="border border-gray-200 rounded-md p-2 m-4">

Newsletter thing

  </div>

  <?php if (!premiumCheck()):
    get_template_part("template-parts/ads/ad-rectangle");

    get_template_part("template-parts/ads/taboola-sidebar");
  endif; ?>
</div>