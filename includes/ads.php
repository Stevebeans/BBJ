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