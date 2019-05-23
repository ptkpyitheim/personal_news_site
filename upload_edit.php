<?php
require 'database.php';
$storyID = $_POST['story_id'];
$commentID = $_POST['comment_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$edit = $_POST['edit'];


$edit_query = $mysqli->prepare("update comment set content = '$edit' where comment_id = ".$commentID);

if(!$edit_query)
    {
        printf("Query Failed ", $mysqli->error);
        exit;
    }

$edit_query->execute();
$edit_query->fetch();

echo '<form action="edit.php" method = "post" id = "back">
            <input type="hidden" name = "story_id" value = "'.$storyID.'">
            <input type="hidden" name = "comment_id" value = "'.$commentID.'">
            <input type="hidden" name = "title" value = "'.$title.'">
            <input type="hidden" name = "content" value = "'.$content.'">

            <button type = "submit">Back</button>
        </form>';
echo'<script type="text/javascript">
document.getElementById("back").submit();
</script>';
?>
