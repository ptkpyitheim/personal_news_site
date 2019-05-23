<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display</title>

    <style>
        <?php include 'css/display.css'; ?>
    </style>
</head>
<body>
    <?php
    require 'database.php';

    $query = $mysqli->prepare("select id, title, content, author from story");

    if(!$query)
        {
            printf("Query Failed ", $mysqli->error);
            exit;
        }
        
    $query->execute();
    $query->bind_result($story_id, $title, $content, $author);


    while($query->fetch()){

        echo "<div class='eachPost'>";
        

        printf("<p id='wholeTitle'> <span id='titleName'> Title: </span> <span id='userTitle'>%s</span> <span id='postby'>posted by</span> <span id='authorName'>%s</span> </p>", $title, $author);
        #printf("<p> Content: %s </p>", $content);
        echo '<form action="comment.php" method = "post">
                <input type="hidden" name = "story_id" value = "'.$story_id.'">
                <button type = "submit" id="viewBtn">View</button>
                </form>';

        echo "</div>";

    }
        
    ?>
    
</body>
</html>


