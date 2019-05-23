<?php
$storyID = $_POST['story_id'];

$title = $_POST['title'];


require 'database.php';

$delete_query = $mysqli->prepare("delete from story where id = ".$storyID);


if(!$delete_query)
    {
        printf("Query Failed ", $mysqli->error);
        exit;
    }

$delete_query->execute();

#$delete_query->fetch();

printf("Deleted: ". $title);

echo '<form action="home.php" method = "post">
            
            <button type = "submit">Back</button>
        </form>';

?>