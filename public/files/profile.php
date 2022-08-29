<?php 

use App\Controller\User;
use App\Controller\Post;
use App\Library\PDO;
use App\Repository\UsersRepository;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

include("handlers/header.php"); 

if(isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $userArray = UsersRepository::validateSession($username);
}

if($userArray['user_closed'] == 'yes') {
    header("Location: user_closed.php");
}

 ?>

        <div class="profile_left">
            <div class="profile_info">
                <p><?php echo "Announcements: " . $userArray['num_posts']; ?></p>
                <p><?php echo "Confirms: " . $userArray['num_likes']; ?></p>
            </div>
        </div>
        
        <div class="main_column column">
            <?php $profile_user_obj = new User(PDO::instance(), $userArray['username']);
            echo 'Username: ' . $profile_user_obj->getUsername(); ?>
            <br>
            <?php $profile_user_obj = new User(PDO::instance(), $userArray['username']);
            echo 'Contact person: ' . $profile_user_obj->getFirstAndLastName(); ?>
            <br>
            <?php echo 'Vendor ID: ' . '110' . $userArray['id']; ?>
            <br>
            <?php echo 'Registered since: ' . $userArray['signup_date']; ?>
        </div>

    </div>
</body>
</html>