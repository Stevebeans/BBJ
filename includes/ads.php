<?php 

function show_header_ad() {
  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
            crossorigin="anonymous"></script>
        <!-- 2023 - Above Header -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-1172879704296990"
            data-ad-slot="2494556659"
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


function show_front_responsive() {
  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
              crossorigin="anonymous"></script>
          <!-- 2023 Front Page Responsive -->
          <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-1172879704296990"
              data-ad-slot="4201378236"
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


function sidebar_ad() {
  if (!premiumCheck()):?>
    <div class="max-w-screen-xl p-4 mx-auto mb-2 relative border-b border-gray-300 flex justify-center items-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1172879704296990"
     crossorigin="anonymous"></script>
<!-- 2023 BBJ Sidebar -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1172879704296990"
     data-ad-slot="3649185218"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <div class="text-xs absolute bottom-0 right-0 bg-slate-50">Don't want ads? <a href="/become-supporter/" class=" text-primary500 hover:underline mt-4">Go premium here</a></div>
    </div>
  <?php 
  endif; }