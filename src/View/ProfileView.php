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
			<div class="profile_left">
				<div class="profile_info">
					<p><?php if (isset($userArray['num_posts'])) echo "Announcements: " . $userArray['num_posts']; ?></p>
					<p><?php if (isset($userArray['num_likes'])) echo "Confirms: " . $userArray['num_likes']; ?></p>
				</div>
			</div>
			
			<div class="main_column column">
				<?php if (isset($userArray['username'])) echo 'Username: ' . $userArray['username']; ?>
				<br>
				<?php if (isset($userArray['last_name'])) echo 'Contact person: ' . $userArray['first_name'] . " " . $userArray['last_name']; ?>
				<br>
				<?php if (isset($userArray['id'])) echo 'Vendor ID: ' . '110' . $userArray['id']; ?>
				<br>
				<?php if (isset($userArray['signup_date'])) echo 'Registered since: ' . $userArray['signup_date']; ?>
			</div>

    	</div>
	</body>
</html>