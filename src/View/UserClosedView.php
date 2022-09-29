<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Vendor Return Management</title>

		<!-- JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="./assets/js/bootstrap.js"></script>
		<script src="./assets/js/bootbox.min.js"></script>
		
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css">

	</head>
	
	<body>

		<div class="top_bar">
			
			<div class="logo">
				<a id="GFG" href="<?php echo '/'; ?>">Vendor Return Management</a>
			</div>

			<nav>
				<a id="GFGN" href="profile?profile_username=<?php echo $user['username']; ?>">Hi there, <?php echo $user['first_name']; ?>!</a>
				<a id="GFG" href="logged_out">Logout</a>
			</nav>

		</div>

        <div class="wrapper">
            <div class="main_column column" id="main_column">
                <h4>User Closed</h4>
                <h9>This account is closed.</h9>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <a href="<?php echo '/'; ?>"> Click here to go back.</a>
            </div>
        </div>
        
    </body>
</html>