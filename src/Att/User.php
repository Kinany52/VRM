<?php 

Namespace App\Att;

use App\Entity\PDO;

class User 
{
	private $user;
	private $con;

	public function __construct($con, $user) {
		$this->con = PDO::instance();
		$user_details_query = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$user_details_query->execute([$user]);
		$this->user = $user_details_query->fetch();
	}

	public function getUsername() {
		return $this->user['username'];
	}

	public function getNumPosts() {
		$username = $this->user['username'];
		$query = PDO::instance()->prepare("SELECT num_posts FROM users WHERE username=?");
		$query->execute([$username]);
		$row = $query->fetch();
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = PDO::instance()->prepare("SELECT first_name, last_name FROM users WHERE username=?");
		$query->execute([$username]);
		$row = $query->fetch();
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function isClosed() {
		$username = isset($this->user['username']);
		$query = PDO::instance()->prepare("SELECT user_closed FROM users WHERE username=?");
		$query->execute([$username]);
		$row = $query->fetch();

		if (isset($row['user_closed']) =='yes') {
			return true;
		}
		else {
			return false;
		}
	}


	public function isFriend($username_to_check) {
		$usernameComma = "," . $username_to_check . ",";
		if((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
			return true;
		}
		else {
			return false;
		}
	}

}

 ?>