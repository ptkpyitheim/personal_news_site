
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            <?php include 'css/home.css'; ?>
        </style>
    </head>
    <body>
       <div id="body">
           
            <div id="first_section">
                <h1>Ultimate News Site</h1>
                
                <?php
                    session_start();
                    $username = $_SESSION['user'];

                    if(isset($username)){
                        $welcome_display = "Welcome ".$username."!";
                        echo "<div id='welcome'> $welcome_display </div>";  
                    }
                    else
                    {
                    echo  '<form action="login.php" id="loginForm">
                        <button type = "submit"  id="loginBtn">    Login</button>
                            </form>';
                    }
                    
                ?>

            </div>

            <hr>

            <div class="story">
                
                <?php
                if(isset($_SESSION['user'])){
                    echo "<h3>What's on your mind?</h3>";
                    
                    echo 
                    '<form action="post.php" required method = "post" id="postForm">
                        <label for="title" id="title">Title:</label>
                        <input type="text" required id="title" name = "title" id="titleTextField"/>
                        <p>Content: </p>
                        <textarea name="story" id="story" ></textarea>
                        <button type = "submit" name = "post" id="postBtn">Post</button>
                    </form>';
                }
                    
                ?>

                <hr>
                <h3 id="stories"> _____ Stories _____ </h3>
                
                <?php
                include("display.php");
                ?> 
            </div>
            





            <form action="logout.php" method="GET">
                <button type="submit" value="" id="logoutBtn">Logout</button>
            </form>
    
        </div>
        
    </body>
</html>

