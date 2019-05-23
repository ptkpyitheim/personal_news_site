<?php
$storyID = $_POST['story_id'];
$commentID = $_POST['comment_id'];

echo $commentID;

require 'database.php';
echo "delete from comment where comment_id = ".$commentID;
$delete_query = $mysqli->prepare("delete from comment where comment_id = ".$commentID);


if(!$delete_query)
    {
        printf("Query Failed ", $mysqli->error);
        exit;
    }

$delete_query->execute();

#$delete_query->fetch();


echo '<form action="comment.php" method = "post" id="back">
            <input type="hidden" name = "story_id" value = "'.$storyID.'">
            <button type = "submit">Back</button>
</form>';
echo '<script type="text/javascript">
document.getElementById("back").submit();
</script>';
?>