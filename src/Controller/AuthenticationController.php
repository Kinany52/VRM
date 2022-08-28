<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Entity\UsersEntity;

Class AuthenticationController
{
    public function authenticate() {
        echo 'testingAuthenticateFunction';
    }

    public function handleRegister() {
        if (isset($_POST['register_button'])) {
	
            //Registeration form value
        
            //First name
            $fname = strip_tags($_POST['reg_fname']); //remove html tags
            $fname = str_replace(' ', '', $fname); //remove spaces
            $fname = ucfirst(strtolower($fname)); //Makes all letters lowercase then only makes first letter uc 
            $_SESSION['reg_fname'] = $fname; //Stores first name into session variable
        
            //Last name
            $lname = strip_tags($_POST['reg_lname']); //remove html tags
            $lname = str_replace(' ', '', $lname); //remove spaces
            $lname = ucfirst(strtolower($lname)); //Makes all letters lowercase then only makes first letter uc 
            $_SESSION['reg_lname'] = $lname; //Stores last name into session variable
        
            //Email
            $em = strip_tags($_POST['reg_email']); //remove html tags
            $em = str_replace(' ', '', $em); //remove spaces
            $em = ucfirst(strtolower($em)); //Makes all letters lowercase then only makes first letter uc 
            $_SESSION['reg_email'] = $em; //Stores email into session variable
        
            //Email 2
            $em2 = strip_tags($_POST['reg_email2']); //remove html tags
            $em2 = str_replace(' ', '', $em2); //remove spaces
            $em2 = ucfirst(strtolower($em2)); //Makes all letters lowercase then only makes first letter uc 
            $_SESSION['reg_email2'] = $em2; //Stores email2 into session variable
        
            //Password
            $password = strip_tags($_POST['reg_password']); //remove html tags
            $password2 = strip_tags($_POST['reg_password2']); //remove html tags
        
            $date = date("Y-m-d"); //Current date
        
            if ($em == $em2) {
                //Check if email is in valid format
                if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
                    
                    $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        
                    //check if email already exists
                    $e_check = UsersRepository::validateEmail($em);
        
                    if (!empty($e_check)) {
                        array_push($error_array, "Email already in use<br>");
                    }
                }
                else {
                    array_push($error_array, "Invalid email format<br>");
                }
            }
            else {
                array_push($error_array, "Emails don't match<br>");
            }
        
        
            if (strlen($fname) > 25 || strlen($fname) < 2) {
                array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
            }
        
            if (strlen($lname) > 25 || strlen($lname) < 2) {
                array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
            }
        
            if ($password != $password2) {
                array_push($error_array, "Your passwords do not match<br>");
            }
            else {
                if (preg_match('/[^A-Za-z0-9]/', $password)) {
                    array_push($error_array, "Your password can only contain English characters or numbers<br>");
                }
            }
        
            if (strlen($password) > 30 || strlen($password) < 5) {
                array_push($error_array, "Your password must be between 5 and 30 characters<br>");
            }
        
            if (empty($error_array)) {
                $password = md5($password); //Encrypt passord before sending to database
        
                //Generate username by concarenating first name and last name
                $username = strtolower($fname . "_" . $lname);
                $check_username_query = UsersRepository::validateUsername($username);
        
                $i = 0;
                //If username exists add number to username
                while (!empty($check_username_query)) {
                    $i++; //Add 1 to i
                    $username = $username . "_" . $i;
                    $check_username_query = UsersRepository::validateUsername($username);
                }
        
                UsersRepository::persistEntity(new UsersEntity(
                    first_name: $fname, 
                    last_name: $lname, 
                    username: $username, 
                    email: $em, 
                    password: $password, 
                    signup_date: $date
                ));
        
                array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span>");
        
                //Clear session variables
                $_SESSION['reg_fname'] = "";
                $_SESSION['reg_lname'] = "";
                $_SESSION['reg_email'] = "";
                $_SESSION['reg_email2'] = "";
            }
        
        }
    }

    public function handleLogin() {
        if (isset($_POST['login_button'])) {
            $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email
        
            $_SESSION['log_email'] = $email; //Store email into session variable
            
            $password = md5($_POST['log_password']); //Get password
            //$password = password_hash($_POST['log_password'], PASSWORD_DEFAULT);
        
            foreach (UsersRepository::authenticateUser($email, $password) as $userRow) {
        
                if ($userRow == 1) {
        
                    $username = $userRow->username;
                    
                    $checkUserStatus = UsersRepository::inquireStatus($email, 'yes');
                    
                    if (empty($checkUserStatus)) {
                        UsersRepository::reactivateUser('no', $email);
                    }
        
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit();
                }
                else {
                    array_push($error_array, "Email or password was incorrect<br>");
                }
            }
        }
    }
}