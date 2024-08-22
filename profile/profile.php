<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);

// session and cookie protection page
if (!isset($_SESSION['user']['islogged']) || $_SESSION['user']['islogged'] != true || $_SESSION['user']['token'] != $_COOKIE['token']){
    header("Location: login.php");
}

if (isset($_POST['submit'])){
    session_unset();
    session_destroy();

    // remove cookie 
    setcookie('token',"", time() - 3600,"/");
    if(isset($_COOKIE['token'])){

        unset($_COOKIE['token']);
    }

    // after this process navigate the login.php
    header("Location: ../login.php");
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/home.css">
    <script>
    function navAddFriend(){
        window.location.href = "./addFriend.php";
    }
</script>

</head>
<body>

    <div id="header"><h2> My friend system</h2></div>

    <div id="container">
        <h4><?php echo $_SESSION['user']['profile_name'] ?>'s Add Friend Page</h4> <br/>
        <p>total number of friend : 0</p> <br/>



        <div id="buttons">
            <button type="button" id="button2" onclick = "navAddFriend()">Add Friend</button>

            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <button type="submit" id="button2" name="submit">Logout</button>
            </form>

        </div>
        
        
    </div>

    <div id="footer"><h4><b>copyright@ setu.kln.ac.lk</b></h4></div>

</body>
</html>