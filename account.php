<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">
    <title>Content page</title>
    
</head>
<body>
    <header>
        <nav class="navbar">
            <ul>
                <li><a href="https://github.com/Rc561U/trainee-validation">GitHub Source</a></li>
                <li><a href="https://www.linkedin.com/in/ramancou/">Linkedin</a></li>
                <li><a href="https://t.me/Numbernein">Telegram</a></li>
                
                <div class="signout" id="signout">
                 <?php session_start();

                 echo "Hello, ".$_SESSION['user']; ?>
                <button id="sendquery">LogOut</button>
                <button onclick="location.href='index.html'" type="button" >SugnUp</button>
                </div>
            </ul>
        </nav>
    </header>
    <script src="js/login.js"></script>
</body>

</html>
