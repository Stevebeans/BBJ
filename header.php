<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald&family=Roboto&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">   
  <?php
  $addFreeExperience = false;

  $bbjAdCheck = "regular";
  $bbjUpdater = "visitor";
  if (is_user_logged_in()):
    if (current_user_can("administrator") || current_user_can("editor")):
      $bbjAdCheck = "premium";
      $bbjUpdater = "updater";
      $addFreeExperience = true;
    endif;
  endif;
  ?>
  <head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1Q771W4ZV2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1Q771W4ZV2');
    </script>


    <?php if (!premiumCheck()): ?>
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3657293189229655"
     crossorigin="anonymous"></script>
     <?php endif; ?>
    

     <?php
     $logIn = is_user_logged_in();

     if ($logIn):
       $currentUser = wp_get_current_user();
     endif;
     ?>

  </head>
  <body <?php body_class(); ?> class="">

  <header> 
    
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
    <nav class="bg-white border-gray-200 rounded dark:bg-gray-900">
      <div class="container flex flex-wrap items-center justify-between mx-auto px-2 py-1 md:p-2">
      
        <div class="hidden md:block"><a href="<?= site_url() ?>"><img src="<?= BBJ_IMAGES . "/bbjlogo2020.png" ?>" alt="<?= get_bloginfo("description") ?>" ></a></div>        
        <div class="block md:hidden"><a href="<?= site_url() ?>"><img src="<?= BBJ_IMAGES . "/bbjlogomobile.png" ?>" alt="<?= get_bloginfo("description") ?>" ></a></div> 

      <div class="flex items-center md:order-2">

        <div class="flex flex-col justify-center items-center mr-2">
          <div class="text-xs text-gray-500">Spoilers</div>
          <div class="mx-auto h-4 flex justify-center items-center"><i class="fa fa-toggle-off text-gray-500" id="toggleSpoiler"></i></div>
        </div>
          <button id="theme-toggle" type="button" class="text-gray-500 mr-2 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
          </button>

          <?php if (is_user_logged_in()): ?>
          <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <?php endif; ?>
            <span class="sr-only">Open user menu</span>
            <?php echo is_user_logged_in() ? '<img class="w-8 h-8 rounded-full" src="' . get_avatar_url($currentUser->ID) . '" alt="' . $currentUser->display_name . '">' : '<img class="bg-white" src="' . BBJ_IMAGES . '/bbjlogomobile.png" alt="' . get_bloginfo("description") . '" >'; ?>
          </button>
          <!-- Dropdown menu -->
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900 dark:text-white"><?= $currentUser->display_name ?></span>
              <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"><?= $currentUser->user_email ?></span>
            </div>
            <ul class="py-1" aria-labelledby="user-menu-button">
              <li>
                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
              </li>
              <li>
                <a href="<?= wp_logout_url() ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
              </li>
            </ul>
          </div>
          <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
        </div>
      </div>
      <div class="flex flex-wrap items-center justify-between mx-auto bg-primary500 px-2 sm:px-4 py-1">
        <div class="container mx-auto hidden lg:flex" id="mobile-menu-2">          
          <ul id="bbj-main-menu" class="menu list-none p-0">
                <?php wp_nav_menu([
                  "theme_location" => "bbj-main-menu",
                  "items_wrap" =>
                    '<ul id="%1$s" class="%2$s nav-class-li">%3$s' .
                    (is_user_logged_in()
                      ? '<li><a href="/dashboard">Settings</a></li>  
                    <li><a href="' .
                        wp_logout_url() .
                        '">Log Out</a></li>'
                      : '
                      <li><a href="/log-in">Log In</a></li>
                      <li><a href="/registration">Register</a></li>
                      ') .
                    "</ul>",
                  "container" => "",
                  "menu_class" => "flex flex-col md:flex-row py-0.5 px-1",
                ]); ?>

          </ul>
        </div>
      </div>
    </nav>

</header>

<section id="main-body" class="bg-slate-200 dark:bg-slate-700">
  
      <?php get_template_part("template-parts/spoiler-bar"); ?>

      <?php if (!premiumCheck()):
        get_template_part("template-parts/ads/ad-header");
      endif; ?>
    
      <div id="user-role" data-role="<?= $bbjAdCheck ?>"></div>
<?php if (feedUpdater()): ?>
  <?php get_template_part("template-parts/feed-updater"); ?>
<?php endif; ?>
