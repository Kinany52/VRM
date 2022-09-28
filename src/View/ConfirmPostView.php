<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    </head>
    <body>

        <?php 
        if($num_rows > 0) {
            echo '<form action="/confirm_post?post_id=' . $post_id . '" method="POST">
                    <input type="submit" class="comment_like" name="unlike_button" value="Disconfirm">
                    <div class="like_value">
                        '. $total_likes .' Confirms
                    </div>
                </form>
            ';
        }
        else {
            echo '<form action="/confirm_post?post_id=' . $post_id . '" method="POST">
                    <input type="submit" class="comment_like" name="like_button" value="Confirm">
                    <div class="like_value">
                        '. $total_likes .' Confirms
                    </div>
                </form>
            ';
        } 
        ?>

        <style type="text/css">
        * {
            font-family: Arial, Helvetica, Sans-serif;
        }
        body {
            background-color: #fff;
        }

        form {
            position: absolute;
            top: 0;
        }
        </style>

    </body>
</html>