<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <?php include 'css/edit.css' ?>
    </style>
</head>
<body>
    <?php

    require 'database.php';
    $storyID = $_POST['story_id'];
    $commentID = $_POST['comment_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    printf("<h1> Title: %s </h1>", $title);
    printf("<h4> Content: %s </h4>", $content);



    $comment_content_query = $mysqli->prepare("select content from comment where comment_id = ".$commentID);


    if(!$comment_content_query)
        {
            printf("Query Failed ", $mysqli->error);
            exit;
        }
    $comment_content_query->execute();
    $comment_content_query->bind_result($comment_content);
    $comment_content_query->fetch();
    echo "Your current comment: ".$comment_content;


    echo '<form action="upload_edit.php" method = "post">
                <input type="hidden" name = "story_id" value = "'.$storyID.'">
                <input type="hidden" name = "comment_id" value = "'.$commentID.'">
                <input type="hidden" name = "title" value = "'.$title.'">
                <input type="hidden" name = "content" value = "'.$content.'">
                <p>Your new comment:</p>
                <textarea name="edit" required id="edit"></textarea>
                <button type = "submit" id="changeBtn">Change</button>
            </form>';

    echo '<form action="comment.php" method = "post">
                <input type="hidden" name = "story_id" value = "'.$storyID.'">
                <button type = "submit" id="backBtn">Back</button>
            </form>';

    ?>
        
</body>
</html> 
 
 
 
 