<?php
require 'database.php';
$storyID = $_POST['story_id'];

$title = $_POST['title'];
$content = $_POST['content'];
$new_content = $_POST['edit_story'];
$new_title = $_POST['edit_title'];


$query = $mysqli->prepare("update story set content = '.$new_content.', title = '.$new_title.' where id = ".$storyID);

if(!$query)
    {
        printf("Query Failed ", $mysqli->error);
        exit;
    }

$query->execute();
$query->fetch();


echo '<form action="edit_story.php" method = "post">
            <input type="hidden" name = "story_id" value = "'.$storyID.'">
            
            <input type="hidden" name = "title" value = "'.$new_title.'">
            <input type="hidden" name = "content" value = "'.$new_content.'">

            <button type = "submit">Back</button>
        </form>';
?>