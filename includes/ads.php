<?php 

function show_header_ad() {
  ?>
    <div class="max-w-screen-xl p-0 md:p-4 mx-auto my-2 border"  id="ad-container">
      
      <div><?php if( function_exists('the_ad') ) {  the_ad('51558'); } ?></div>
      
    </div>

  <?php 

}

function sidebar_ad() {
  ?>
    <div class="max-w-screen-xl p-0 md:p-4 mx-auto my-2 border"  id="ad-container">
      <?php 
      if( function_exists('the_ad_group') ) { the_ad_group(5928); } ?>
    </div>

  <?php 
}


function show_front_responsive() { ?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative">
      <div class=" text-gray-600 text-sm">Advertisement:</div>
      <div><?php
      
      if( function_exists('the_ad_group') ) { the_ad_group(5929); }?></div>
              
    </div>
  <?php
}

function show_after_content() {
  ?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-t border-gray-200 border-b">
      <div class=" text-gray-600 text-sm">Advertisement:</div>
      <div><?php
      
      if( function_exists('the_ad_group') ) { the_ad_group(5930); }?></div>
              
    </div>
  <?php
}

function show_front_feed_updates() {
  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative ">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
                crossorigin="anonymous"></script>
            <!-- 2023 Feed Update Index -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-1172879704296990"
                data-ad-slot="7061892596"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        <div class="text-xs absolute bottom-0 right-0 bg-slate-50">Don't want ads? <a href="/become-supporter/" class=" text-primary500 hover:underline mt-4">Go premium here</a></div>
    </div>
  <?php 
  endif;
}

function show_in_feed_ads() {
  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-b border-gray-300">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
        crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-ew-68+fy+62-149"
        data-ad-client="ca-pub-1172879704296990"
        data-ad-slot="2313581496"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
        <div class="text-xs absolute bottom-0 right-0 bg-slate-50">Don't want ads? <a href="/become-supporter/" class=" text-primary500 hover:underline mt-4">Go premium here</a></div>
    </div>
  <?php 
  endif;
}

function in_article_google() {
  ob_start(); // Start output buffering to capture everything that's printed

  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-b border-gray-300">
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
      crossorigin="anonymous"></script>
  <ins class="adsbygoogle"
      style="display:block; text-align:center;"
      data-ad-layout="in-article"
      data-ad-format="fluid"
      data-ad-client="ca-pub-1172879704296990"
      data-ad-slot="6226488922"></ins>
  <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
        <div class="text-xs absolute bottom-0 right-0 bg-slate-50">Don't want ads? <a href="/become-supporter/" class=" text-primary500 hover:underline mt-4">Go premium here</a></div>
    </div>
  <?php 
  endif;

  return ob_get_clean(); // Retrieve the buffered content as a string
}

function taboola_mid() {
  ob_start(); // Start output buffering

  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-b border-gray-300">
      <script type="text/javascript">
            window._taboola = window._taboola || [];
            _taboola.push({
              mode: 'thumbnails-mid',
              container: 'taboola-mid-article-thumbnails',
              placement: 'Mid Article Thumbnails',
              target_type: 'mix'
            });
          </script>
      <div class="text-xs absolute bottom-0 right-0 bg-slate-50">Don't want ads? <a href="/become-supporter/" class=" text-primary500 hover:underline mt-4">Go premium here</a></div>
    </div>
  <?php 
  endif;

  return ob_get_clean(); // Retrieve the buffered content as a string
}


