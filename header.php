<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>



  <header>
    
  <div class="container">



  
    <div class="headerContain">      
      <div class="headerLeft">
        <div class="headerLogoFull"><a href="<?php echo site_url()?>"><img src="<?php echo get_theme_file_uri('/images/bbjlogo2020.png') ?>" alt="<?php echo get_bloginfo( 'description' ); ?>"></a></div>
        <div class="headerLogoMobile"><a href="<?php echo site_url()?>"><img src="<?php echo get_theme_file_uri('/images/bbjlogomobile.png') ?>" alt="<?php echo get_bloginfo( 'description' ); ?>"></a></div>
        <div class="searchBar"><input type="text" name="" id="" placeholder="Search"></div>
      </div>
      <div class="mobileMenu">
        <i class="mobileMenu__icon fa fa-bars" aria-hidden="true"></i>
      </div>
      <div class="regMenu">
      
        <button class="menuButtons btn__left">Login</button>
        <button class="menuButtons">Sign Up</button>
      </div>
    </div>
    <div class="menuFull">
      <div class="menu">
        <a href="http://">dsaf</a>
        <a href="http://">adfsd</a>
        <a href="http://">adfdsf</a>
        <a href="http://">afsd</a>
      </div>
      
      
      <div class="spoilerTrigger">
        <div class="spoilerTriggerText">Spoiler Bar: <i class="fa fa-toggle-off" id="toggleSpoiler"></i></div> 
      </div>
    </div>
      <div class="menuShow">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
        <li>
          <div class="loginButtons">
            <div><button class="menuButtons">Login</button></div>
            <div><button class="menuButtons">Sign Up</button></div>
            
          </div>
        </li>
      </ul>
    </div>
    <div class="spoilerBar">
      <div class="playerDiv">

      
        <div><a href="/bbplayer/alyssa-lopez/"><img src="<?php echo get_theme_file_uri('/images/alyssa-th.jpg') ?>" alt="Alyssa Big Brother 23"></a></div>
      </div>
      <div class="closingBar"></div>
    </div>

    


    
  </div>



  </header>