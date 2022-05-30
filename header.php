<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
  </head>
  <body <?php body_class(); ?>>



  <header>
    
  <div class="container">

    <?php // Get logged in user info

if (is_user_logged_in()):
      $currentUser = wp_get_current_user();
    endif; ?>

  
    <div class="headerContain"> 
      <div class="header-content">
        <div class="headerLeft">
          <div class="headerLogoFull"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_file_uri("/images/bbjlogo2020.png"); ?>" alt="<?php echo get_bloginfo("description"); ?>"></a></div>
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
          <div class="menuButtons btn__left"><a href="<?php echo site_url(); ?>/dashboard">Settings</a></div>   
          <div class="menuButtons"><a href="<?php echo wp_logout_url(); ?>">Log Out</a></div>       
          <?php else: ?>
          <div class="menuButtons btn__left"><a href="<?php echo site_url(); ?>/log-in">Login</a></div>
          <div class="menuButtons"><a href="<?php echo site_url(); ?>/registration">Sign Up</a></div>
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
        <div class="spoilerTriggerText">Spoiler Bar: <i class="fa fa-toggle-off" id="toggleSpoiler"></i></div> 
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
        <?php else: ?>
            <div><a href="<?php echo site_url(); ?>/log-in">Login</a></div>
            <div><a href="<?php echo site_url(); ?>/registration">Sign Up</a></div>
        <?php endif; ?>  
          </div>
    </div>
      <?php get_template_part("template-parts/spoiler-bar"); ?>

    


    
  </div>



  </header>