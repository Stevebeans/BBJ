<!DOCTYPE html>
<html <?php language_attributes(); ?>>    
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


    <?php if (!premiumCheck()):
      if (function_exists("adinserter")):
        echo adinserter(1);
      endif;
    endif; 

    $logIn = is_user_logged_in();

    if ($logIn):
      $currentUser = wp_get_current_user();
    endif; ?>

  </head>
  <body <?php body_class(); ?>>



    <!--  New TW Header  
    
    <header id="main-header" class="mb-2 bg-white py-4 px-2 max-w-full flex justify-between">
      <div class="border w-[400px] flex items-center">
        <div class="hidden md:block"><a href="<?= site_url() ?>"><img src="<?= BBJ_IMAGES . '/bbjlogo2020.png' ?>" alt="<?= get_bloginfo("description");?>" ></a></div>        
        <div class="block md:hidden"><a href="<?= site_url() ?>"><img src="<?= BBJ_IMAGES . '/bbjlogomobile.png' ?>" alt="<?= get_bloginfo("description");?>" ></a></div> 
      </div>
      <div class="border  w-full"></div>
      <div class="border w-[350px] flex justify-around">
        <?php if (is_user_logged_in()): ?>
          <div class="bbj-btn border-2">
            <a href="<?php echo site_url(); ?>/dashboard">Settings</a>
          </div>
        <?php else: ?>
          <a href="<?php echo site_url(); ?>/dashboard"><div class="bbj-btn mr-2">Login</div></a>
          <a href="<?php echo site_url(); ?>/dashboard"><div class="bbj-btn">Sign Up</div></a>
          
           
          
        <?php endif;?>
      </div>
    </header>-->

  <header>


    
  <div class="bbj-container">
    


  
    <div class="headerContain"> 

      
      <div class="header-content">
        <div class="headerLeft">
          <div class="flex justify-start"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_file_uri("/images/bbjlogo2020.png"); ?>" alt="<?php echo get_bloginfo("description"); ?>"></a></div>
          <div class="headerLogoMobile"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_file_uri("/images/bbjlogomobile.png"); ?>" alt="<?php echo get_bloginfo("description"); ?>"></a></div>
          <div class="search-wrapper">
            <div class="search-bar">
              <?php
              $searchForm = '[ivory-search id="44859" title="Default Search Form"]';
              echo do_shortcode($searchForm);
              ?>

              <!--<input type="text" name="bbj_search" id="bbj_search" placeholder="Search">
              <div class="search-dropdown">gf</div>-->
            </div>
          </div>
        </div>
        
        <div class="mobileMenu">
          <i class="mobileMenu__icon fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="regMenu">
          <?php if (is_user_logged_in()): ?> 
          <a href="<?php echo site_url(); ?>/dashboard"><div class="bbj-btn mr-2">Settingss</div></a>   
          <a href="<?php echo wp_logout_url(); ?>"><div class="bbj-btn">Log Out</div></a>       
          <?php else: ?>
          <a href="<?php echo site_url(); ?>/log-in"><div class="bbj-btn mr-2">Login</div></a>
          <a href="<?php echo site_url(); ?>/registration"><div class="bbj-btn">Sign Up</div></a>
          <?php endif; ?>
        </div>
      </div>     
      
      
    </div>
    <div class="menuFull">
      <div class="menu">
      <?php wp_nav_menu([
        "theme_location" => "bbj-main-menu",
        "menu_class" => "navigation-main",
      ]); ?>
      <script>
        jQuery(function ($) {
        var siteNavigation = $('.navigation-main');
        
        siteNavigation.find( 'a' ).on( 'focus blur', function() {
          $( this ).parents( 'li' ).toggleClass( 'focus' );
        });
      });
      </script>
      </div>
      
      
      <div class="spoilerTrigger">
        <div class="spoilerTriggerText">Spoiler Bar: <i class="fa fa-toggle-on" id="toggleSpoiler"></i></div> 
      </div>
    </div>
      <div class="menuShow">
        <?php wp_nav_menu([
          "theme_location" => "bbj-main-menu",
          "menu_class" => "navigation-main-mobile",
        ]); ?>
        <div class="loginButtons">
        <?php if (is_user_logged_in()): ?>          
        <div><a href="<?php echo site_url(); ?>/dashboard">Account Settings</a></div>
        <div><A href="<?php echo wp_logout_url(); ?>">Log Out</a></div>
        <?php else: ?>
            <div><a href="<?php echo site_url(); ?>/log-in">Login</a></div>
            <div><a href="<?php echo site_url(); ?>/registration">Sign Up</a></div>
        <?php endif; ?>  
          </div>
    </div>
      <?php get_template_part("template-parts/spoiler-bar"); ?>

    
      <div class="bodyContainer">
          <?php if (!premiumCheck()):
            // Header Ad Space
            if (function_exists("adinserter")) {
              //echo adinserter(2);
            }
          endif; ?>  
      </div>


      

      <div id="user-role" data-role="<?= $bbjAdCheck ?>"></div>

    
  </div>


  

  </header>
  <?php if (feedUpdater()): ?>
  <div id="update-box" data-update="<?= $bbjUpdater ?>">
    <div class="update-box-header">Feed Updates
      <div class="update-box-button"><i class="fa fa-toggle-on" id="toggle_feed_update"></i></div>
    </div>
    <div class="update-box-body"><?php echo FrmFormsController::get_form_shortcode(["id" => 5, "title" => false, "description" => true]); ?></div></div>
  <?php endif; ?>
