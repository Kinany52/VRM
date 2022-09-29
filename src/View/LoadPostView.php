<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<script>
	function toggle<?php echo $id; ?>() {

		var target = $(event.target);
		if (!target.is("a")) {
				var element = document.getElementById("toggleComment<?php echo $id; ?>");

				if(element.style.display == "block")
					element.style.display = "none";
				else
					element.style.display = "block";
		}

	}
</script>
</body>
</html>