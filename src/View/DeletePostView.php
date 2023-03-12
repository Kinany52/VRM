<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title></title>
	<!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/bootbox.min.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

    <script>
        $(document).ready(function() {
            $('.delete_button[data-post-id="<?php echo $id; ?>"]').on('click', function() {
                bootbox.confirm("Are you sure you want to delete this announcement?", function(result) {

                    $.post("<?php echo '/delete_post?post_id=' . $id; ?>", {result:result});

                    if(result)
                        location.reload();

                });
            });
        });
    </script>
</body>
</html>