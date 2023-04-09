<?php get_header(); ?>


<div class="bbj-container-inner">

  <div class="mt-2 flex w-full flex-col bg-white lg:flex-row overflow-hidden">
    <div class="flex-grow">
      <div class="p-2">
        <h1 class="font-mainHead text-2xl text-primary500">Title</h1>
        <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>
      </div>
    </div>
    <div class="w-full md:w-[320px]  flex-shrink-0">
		<?php get_template_part("template-parts/sidebar-default"); ?>
		</div>
  </div>
</div>


<?php get_footer(); ?>