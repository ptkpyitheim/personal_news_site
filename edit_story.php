<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Story</title>
    <style>
        <?php
            include 'css/edit.css'
        ?>
    </style>
</head>
<body>
    <?php
    require 'database.php';
        $storyID = $_POST['story_id'];
        
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        printf("<h1>Title: %s</h1>", $title);
        printf("<h4>Content: %s</h4>", $content);

    
        echo '<form action="new_story.php" method = "post">
                <input type="hidden" name = "story_id" value = "'.$storyID.'">
                
                <input type="hidden" name = "title" value = "$title">
                <input type="hidden" name = "content" value = "$content">
                <p>Change Story </p>
                <textarea name="edit_story"required id="edit_story" cols="30" rows="10"></textarea>
                <p>Change Title </p>
                <textarea name="edit_title" required id="edit_title" cols="30" rows="0"></textarea>
                <button type = "submit" id="changeBtn">Change</button>
            </form>';
        echo '<form action="comment.php" method = "post">
                <input type="hidden" name = "story_id" value = "'.$storyID.'">
                <button type = "submit" id="backBtn">Back</button>
            </form>';
    ?>
    
</body>
</html>



