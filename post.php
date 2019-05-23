<?php

    require 'database.php';
    session_start();
    $title = $_POST['title'];
    $content = $_POST['story'];
    $author = $_SESSION['user'];
    echo $title, $content;
    $query = $mysqli->prepare("insert into story (title, content, author) values (?, ?, ?)");

    if(!$query){
        printf("Query Failed: ", $mysqli->error);
        exit;
    }
    
    $query->bind_param('sss', $title, $content, $author);
    $query->execute();
    $query->close();

    header("Location: home.php");
    
?>