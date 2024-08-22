<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();

include_once ("Connection/connection.php");

function user_input($data){
    $data = trim($data);    
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errors = array();

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $email = user_input($_POST['email']);
    $password = user_input($_POST['password']);

    if (empty($email) || empty($password)){
        $errors[] = "email or password empty";

    }elseif(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){

        $errors[] = 'email is not valid';
    }

    try{
        if (count($errors) == 0){
            
            $query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1 ;";

            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                $token = bin2hex(random_bytes(16));

                // user details save session assosiative array
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'profile_name'=> $row['profile_name'],
                    'islogged' => true,
                    'token' => $token
                ]; 

                setcookie('token',$token, time()+ 3600*2 ,'/'); // save the cookie in browser

                header("Location: profile/profile.php");

            }else{
                $errors[] = "Invalid email or password";
            }
        }
    }catch(Exception $e){
        $errors[] = $e->getMessage();
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/home.css">
</head>
<body>

    <div id="header"><h2> My friend system</h2></div>

    <div id="container">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Registration Page</h3>
            
                <?php 

                    if (!empty($errors)){
                        echo "<p id='error'> $errors[0]</p>";
                    }
                ?>
            
                <div id="content">
                    
                    <div id="name">
                        <lable>Email</lable><br>
                        <lable>Password</lable><br>
                    </div>
                    <div id="field">
                        <input type="email" name="email"><br>
                        <input type="password" name="password"><br>
                    </div>
                </div>
                <button type="submit">Login</button>
                <button type="reset">Clear</button>
        </form>
    </div>

    <div id="footer"><h4><b>copyright@ setu.kln.ac.lk</b></h4></div>
<script src="js/home.js"></script>
</body>
</html>