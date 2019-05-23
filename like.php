<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <?php 

        require 'database.php';
        $user = $_POST['author'];
        $storyID = $_POST['story_id'];
        $num_likes = $_POST['likes'];
        $num_likes = $num_likes + 1;
        $query = $mysqli->prepare("update story set likes = '.$num_likes.' where id = ".$storyID);


        if(!$query)
            {
                printf("Query Failed ", $mysqli->error);
                exit;
            }
        $query->execute();
        $query->fetch();
        echo '<h1> Thank You! </h1>';

        echo '<form action="comment.php" method = "post" id = "back">
                    <input type="hidden" name = "story_id" value = "'.$storyID.'">
                    <button type = "submit">Back</button>
                </form>';
        echo '<script type="text/javascript">
        document.getElementById("back").submit();
        </script>';
        ?>
       
</body>
</html>
