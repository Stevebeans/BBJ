<?php get_header(); ?>
<?php $current_feed_update_count = get_user_meta(get_current_user_id(), 'feed_update_count', true);
 ?>

<div class="bbj-container-inner">


  <div class="bbj-inner-content-container">
    <div class="bbj-content-container">
        <h1 class="font-mainHead text-2xl text-primary500">User Dashboard</h1>
          <div class="h-[6px] bg-second500 w-[100px] mb-4"></div>
      
    
      
          <?php if ( is_user_logged_in() ): ?>            

            <form method="post">
              <div class="border p-4 shadow-md rounded-md">
                <div class="font-bold text-lg">User / Supporter Settings</div>
                <div class="text-sm">Supporters Only 

                <?php echo !premiumCheck() ? '<a href="/become-supporter">Become a supporter today</a>!' : '-- Thanks for being a supporter' ?>

                <div class="border-t border-gray-400 my-3 "></div>
                <div class="mb-2 flex items-center">
                  <div class="w-52"><label for="update-count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white w-52">Feed Update Count</label></div>
                  <div class="w-full"><select name="feed_update_count" id="feed_update_count" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="10" <?php echo ($current_feed_update_count == '10') ? 'selected' : ''; ?>>10</option>
                  <option value="20" <?php echo ($current_feed_update_count == '20') ? 'selected' : ''; ?>>20</option>
                  <option value="30" <?php echo ($current_feed_update_count == '30') ? 'selected' : ''; ?>>30</option>
                  <option value="50" <?php echo ($current_feed_update_count == '50') ? 'selected' : ''; ?>>50</option>

                  </select>
                  </div>       
                </div>
                <div class="w-full py-3 border-b border-gray-200">This option will be how many feed updates you are shown on the live feed update threads (and more to come soon)</div>
                
                <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />

                </div>
              </div>

              <div class="border p-4 shadow-md rounded-md mt-6">
                <div class="font-bold text-lg">Profile Settings</div>
                

                
                <div class="border-t border-gray-400 my-3 "></div>
                <div class="mb-2 items-center grid grid-cols-2 md:grid-cols-4">
                  <div class=""><label for="display_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white w-52">Display Name</label></div>
                  <div class="">
                    <input type="text" name="display_name" id="display_name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo get_the_author_meta('display_name', get_current_user_id()); ?>" />
                  </div>
                
                </div>
              </div>


                <input type="submit" value="Save Changes" class="bbj-btn mt-4 ">
            </form>


          <?php else: ?>

          <div class="border p-4 shadow-md rounded-md">
            <div class="text-lg">You must be logged in to access this page</div>

            <div class="">

              <div class="my-4"><a href="/log-in" class="btn btn-primary">Log In</a></div>

              <div class="my-4"><a href="/registration" class="btn btn-primary">Register</a></div> 
              
                  

            </div>

          </div>
            <?php endif; ?>
    </div>

    <div>
        <?php get_template_part("template-parts/sidebar-default"); ?>
    </div>
  </div>




</div>


<?php get_footer(); ?>
