<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    
    $comments = $_POST['comment'];
    $storyID = $_POST['story_id'];
    $author = $_POST['author'];
    

    require 'database.php';
    $upload_comment_query = $mysqli->prepare("insert into comment (story_id, author, content) values (?, ?, ?)");


    

    if(!$upload_comment_query)
    {
        printf("Query Failed ", $mysqli->error);
        exit;
    }

    
    $upload_comment_query->bind_param('sss', $storyID, $author, $comments);
    $upload_comment_query->execute();
    $upload_comment_query->close();

    
    echo '<form action="comment.php" method = "post" id="back">
            <input type="hidden" name = "story_id" value = "'.$storyID.'">
            <button type = "submit">Comment</button>
            </form>';
    echo '<script type="text/javascript">
    window.onload = function() {
       document.forms["back"].submit();
    }
    </script>';
    
?>





</body>
</html>


