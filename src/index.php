<?php 

use App\Att\User;
use App\Att\Post;
use App\Entity\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

include("includes/header.php");

if(isset($_POST['post'])){
    $post = new Post(PDO::instance(), $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
    header("Location: index.php"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
}

 ?> 
        <div class="user_details column">   
            <div class="user_details_left_right">
                <a href="profile.php?profile_username=<?php echo $userLoggedIn; ?>">
                <?php
                echo $user['first_name'] . " " . $user['last_name'];
                 ?>
                </a>
                <br>
                <?php
                echo "Announcements: " . $user['num_posts']. "<br>";
                echo "Confirms: " . $user['num_likes']; 
                 ?>
            </div> 
        </div>

        <div class="main_column column">
            <form class="post_form" action="index.php" method="POST">
                <textarea name="post_text" id="post_text" placeholder="Has a return recently arrived?"></textarea>
                <input type="submit" name="post" id="post_buttom" value="Announce">
                <hr>

            </form>
            
             <div class=posts_area></div>
             <img id="loading" src="assets/images/icons/loading.gif">
        </div>

        <script>
        $(function(){

                var userLoggedIn = '<?php echo $userLoggedIn; ?>';
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
                        url: "includes/handlers/ajax_load_posts.php",
                        type: "POST",
                        data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                        cache:false,
                        //alert("hello")
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