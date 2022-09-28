<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>

	<style type="text/css">
	* {
		font-size: 12px;
		font-family: Arial, Helvetica, Sans-serif;
	}

	</style>

 	<script>
 		function toggle() {
 			var element = document.getElementById("comment_section");

 			if(element.style.display == "block")
 				element.style.display = "none";
 			else
 				element.style.display = "block";
 		}
 	</script>

    <form action="/comment_frame?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
 		<textarea name="post_body"></textarea>
 		<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">	
 	</form>
    
</body>
</html>