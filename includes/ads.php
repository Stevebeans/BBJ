<?php 

function show_header_ad() {
  ?>
    <div class="max-w-screen-xl p-0 md:p-4 mx-auto my-2 border"  id="ad-container">
      
      <div><?php if( function_exists('the_ad_placement') ) { the_ad_placement('header'); } ?></div>
      
    </div>

  <?php 

}

function sidebar_ad() {
  ?>
    <div class="max-w-screen-xl p-0 md:p-4 mx-auto my-2 border"  id="ad-container">
      <?php 
      if( function_exists('the_ad_placement') ) { the_ad_placement('sidebar-split'); }
      
      ?>
    </div>

  <?php 
}


function show_front_responsive() { ?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative">
      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('front-page'); } ?>
              
    </div>
  <?php
}

function show_after_content() {
  ?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-t border-gray-200 border-b">
      
      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('after-content'); } ?>
              
    </div>
  <?php
}



//
function show_front_feed_updates() {?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative ">
            <?php if( function_exists('the_ad_placement') ) { the_ad_placement('between-posts'); } ?>
    </div>
  <?php 
  
}


// This is in the live-feed-updates between posts
function show_in_feed_ads() { ?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-b border-gray-300">
        <?php if( function_exists('the_ad_placement') ) { the_ad_placement('between-feed-updates'); } ?>
    </div>
  <?php 
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


