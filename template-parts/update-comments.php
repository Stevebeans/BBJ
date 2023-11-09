<?php
              // Get users with role 'administrator'
              $post_id = get_query_var('post_id', 1);



              $admin_users = get_users(['role' => 'administrator']);
              $feed_updater_users = get_users(['role' => 'updater']);
              $second_in_command = get_users(['role' => 'second_in_command']);

              // Combine the two arrays into one
              $all_users = array_merge($admin_users, $feed_updater_users, $second_in_command);

              // Extract user IDs
              $user_ids = array_map(function ($user) {
                  return $user->ID;
              }, $all_users);

              // Get all latest comments from specified roles
              $latest_comments = get_comments([
                  'author__in' => $user_ids,
                  'post_id' => $post_id,
                  'number' => 3,
                  'orderby' => 'comment_date',
                  'order' => 'DESC',
              ]);

              if ($latest_comments): // Check if admin comments exist
              ?>
                  <div class="border-l border-r border-b border-yellow-400 bg-yellow-50 w-[95%] mx-auto flex flex-col p-2">
                      <div class="font-ibm text-sm"><i class="fa-solid fa-crown"></i> Admin Comments</div>
                      <?php
                      foreach ($latest_comments as $comment) {
                          $avatar_url = get_avatar_url($comment->user_id);
                          $display_name = get_the_author_meta('display_name', $comment->user_id);
                        ?>
                        <div class="admin-comment flex border-b border-yellow-100 mt-1">
                          <div><img src="<?= $avatar_url ?>" class="rounded-full w-4 h-4 mr-2" alt=""></div>
                          <div class="text-xs font-ibm mr-2"><?= $display_name ?></div>
                          <div class="text-xs"><?= $comment->comment_content ?></div>
                          
                           
                        </div>
                      <?php } ?>
                  </div>
              <?php
              endif; // End if for checking admin comments
              ?>


          
            

            <?php
            
              // Get users with roles 'supporter' and 'comment-mod'
              $supporter_users = get_users(['role' => 'supporter']);
              $comment_mod_users = get_users(['role' => 'comment_mod']);

              // Combine both arrays into one
              $all_users = array_merge($supporter_users, $comment_mod_users);

              // Extract user IDs
              $supporter_ids = array_map(function ($user) {
                  return $user->ID;
              }, $all_users);

              // Get the latest comment from users with role 'supporter' or 'comment-mod'
              $latest_comment = get_comments([
                  'author__in' => $supporter_ids,
                  'post_id' => $post_id,
                  'number' => 1,
                  'orderby' => 'comment_date',
                  'order' => 'DESC',
              ]);



            if ($latest_comment) {
              $comment = array_shift($latest_comment);?>         
              <div class="border-l border-r border-b border-gray-400 bg-sky-50 rounded-b-md w-[95%] mx-auto flex flex-col p-2">
                <div class="font-ibm text-sm"><i class="fa-solid fa-award"></i> Recent Supporter Comment  <a href="/become-supporter/" class="text-xs underline visited:underline">(Become A Supporter)</a></div>
                <div class="flex mt-1">
                  <div><img src="<?= get_avatar_url($comment->user_id) ?>" class="rounded-full w-4 h-4 mr-2" alt=""></div>
                  <div class="text-xs font-ibm mr-2"><?= get_the_author_meta('display_name', $comment->user_id) ?></div>
                  <div class="text-xs"><?= $comment->comment_content ?></div>
                </div>
              </div>
            <?php 
            }
            ?>
          