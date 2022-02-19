<?php 

use App\Att\User;
use App\Att\Post;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$con = config();
bootstrap();
 
include("includes/header.php"); 

if(isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
  $user_array = mysqli_fetch_array($user_details_query);

  $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}

 ?>

        <style type="text/css">
             .wrapper {
                  margin-left: -10px;
                  padding-lef: 0px;
              }  
        </style>

        <div class="profile_left">
            <img src="<?php echo $user_array['profile_pic']; ?>">

            <div class="profile_info">
                <p><?php echo "Announcements: " . $user_array['num_posts']; ?></p>
                <p><?php echo "Confirms: " . $user_array['num_likes']; ?></p>
                <p><?php echo "Vendors: " . $num_friends; ?></p>
            </div>

            <form action="<?php echo $username; ?>">
                <?php 
                $profile_user_obj = new User($con, $username);
                if($profile_user_obj->isClosed()) {
                    header("Location: user_closed.php");
                }

                $logged_in_user_obj = new User($con, $userLoggedIn);

                if($userLoggedIn != $username) {

                    if($logged_in_user_obj->isFriend($username)) {
                        echo '<input type="submit" name="remove_friend" class="danger" value="Offboard Vendor"><br>';
                    }
                }
                ?>
            </form>
        </div>
        
        <div class="main_column column">
            <?php echo $username; ?>
        </div>

<script>
 $(function(){
 
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';
    var profileUsername = '<?php echo $username; ?>';
    var inProgress = false;
  
         loadPosts(); //Load first posts
  
         $(window).scroll(function() {
             var bottomElement = $(".status_post").last();
             var noMorePosts = $('.posts_area').find('.noMorePosts').val();            
         
             // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
             if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
             loadPosts();
            }
         });
  
         function loadPosts() {
             if(inProgress) { //If it is already in the process of loading some posts, just return
             return;
             }
           
             inProgress = true;
             $('#loading').show();
  
             var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'
  
             $.ajax({
                 url: "includes/handlers/ajax_load_profile_posts.php",
                 type: "POST",
                 data: "page="+page+"&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
                 cache:false,
  
                 success: function(response) {
                     $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
                     $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
                     $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage
  
                     $('#loading').hide();
                     $(".posts_area").append(response);
  
                     inProgress = false;
                 }
             });
         }
  
         //Check if the element is in view
         function isElementInView (el) {
             if(el == null) {
                 return;
             }
  
             var rect = el.getBoundingClientRect();
  
             return (
                 rect.top >= 0 &&
                 rect.left >= 0 &&
                 rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                 rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
             );
         }
     });
 </script>        


    </div>
</body>
</html>