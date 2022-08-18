<?php 

use App\Controller\User;
use App\Controller\Post;
use App\Library\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

include("includes/header.php"); 

if(isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $user_details_query = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
  $user_details_query->execute([$username]);
  $user_array = $user_details_query->fetch();
}

if($user_array['user_closed'] == 'yes') {
    header("Location: user_closed.php");
}

 ?>

        <div class="profile_left">
            <div class="profile_info">
                <p><?php echo "Announcements: " . $user_array['num_posts']; ?></p>
                <p><?php echo "Confirms: " . $user_array['num_likes']; ?></p>
            </div>
        </div>
        
        <div class="main_column column">
            <?php $profile_user_obj = new User(PDO::instance(), $user_array['username']);
            echo 'Username: ' . $profile_user_obj->getUsername(); ?>
            <br>
            <?php $profile_user_obj = new User(PDO::instance(), $user_array['username']);
            echo 'Contact person: ' . $profile_user_obj->getFirstAndLastName(); ?>
            <br>
            <?php echo 'Vendor ID: ' . '110' . $user_array['id']; ?>
            <br>
            <?php echo 'Registered since: ' . $user_array['signup_date']; ?>
        </div>

    </div>
</body>
</html>