<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment</title>

    <style>
        <?php include 'css/comment.css'; ?>
    </style>
</head>
<body>
    <?php
    session_start();
    $current_user = $_SESSION['user'];
    $story_id = $_POST['story_id'];
    
    require 'database.php';
    

    $query = $mysqli->prepare("select id, title, content, author, likes from story where id = ".$story_id);
    
    if(!$query)
    {
        printf("Query Failed on Comment ", $mysqli->error);
        exit;
    }

    $query->execute();
    $query->bind_result($id, $title, $content, $author, $num_likes);


        while($query->fetch()){


            printf("<h1> Title: %s </h1>", $title);
            printf("<h2> Author: %s </h2>", $author);
            printf("<p> Content: %s </p>", $content);
        }
    echo $num_likes." Likes";

    echo '<form action="like.php" method = "post" id="likeForm">
    <input type="hidden" name = "story_id" value = "'.$story_id.'">   
    <input type="hidden" name = "author" value = "'.$current_user.'">  
    <input type="hidden" name = "likes" value = "'.$num_likes.'">    
    <button type = "submit" id="likeBtn">Like Post</button>
    </form>';

    echo "<hr>";

    
    if($author === $current_user)
    {
        echo '<form action="edit_story.php" method = "post">
        
        <input type="hidden" name = "story_id" value = "'.$story_id.'">
        <input type="hidden" name = "title" value = "'.$title.'">
        <input type="hidden" name = "content" value = "'.$content.'">
        
        <button type = "submit">Edit Story</button>
        </form>';
        
        echo '<form action="delete_story.php" method = "post">
            
            <input type="hidden" name = "story_id" value = "'.$story_id.'">
            <input type="hidden" name = "title" value = "'.$title.'">
            <button type = "submit">Delete Story</button>
            </form>';

    }
    
    
    if(isset($current_user)){
        echo '<form action="upload_comment.php" method = "post">
        <input type="hidden" name = "story_id" value = "'.$story_id.'">
        <input type="hidden" name = "author" value = "'.$current_user.'" >
        <p>Your Comment: </p>
        <textarea name="comment" required id="yourComment"></textarea>
        <button type = "submit" id="commentBtn">Comment</button>
        </form>';
    
    }else{
        echo "login to comment";
    }
    
    

    $comment_query = $mysqli->prepare("select comment_id, story_id, author, content from comment where story_id = ".$story_id);
    if(!$comment_query)
    {
        printf("Comment_Query Failed ", $mysqli->error);
        exit;
    }else{
        $comment_query->execute();
        $comment_query->bind_result($commentID, $story_id, $comment_author, $comment_content);
        
            while($comment_query->fetch()){
                printf("<p> <span id='author'>%s</span> : <span id='authorComment'>%s</span> </p>",$comment_author, $comment_content);
                if($comment_author === $current_user){
                    echo '<div class="commentSection">';

                        echo '<form action="edit.php" method = "post" id="commentForm">
                            <input type="hidden" name = "comment_id" value = "'.$commentID.'">
                            <input type="hidden" name = "story_id" value = "'.$story_id.'">
                            <input type="hidden" name = "title" value = "'.$title.'">
                            <input type="hidden" name = "content" value = "'.$content.'">
                            <button type = "submit" id="editBtn">Edit Comment</button>
                        </form>';
                        
                        echo '<form action="delete.php" method = "post">
                        <input type="hidden" name = "comment_id" value = "'.$commentID.'">
                        <input type="hidden" name = "story_id" value = "'.$story_id.'">
                        <button type = "submit" id="deleteBtn">Delete</button>
                        </form>';

                    echo '</div>';
                }

            }
    }
    





    ?>
    
    <div id="backHome">
        <a  href="home.php"> Back to Home </a>
    </div>
    
    

</body>
</html> 
