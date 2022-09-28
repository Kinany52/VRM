<?php 

namespace App\Controller;

use App\Library\PDO;
use App\Repository\UsersRepository;

class UserController 
{
	private $user;
	private $con;

	public function __construct($con, $user) {
		$this->con = PDO::instance();
		$this->user = UsersRepository::queryUser($user);
	}
}