<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

include_once ("Connection/connection.php");

// filter values
function user_input($data){
    $string = trim($data);
    $string = stripcslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // get user input data in post method and filter values
    $email = user_input($_POST['email']);
    $profile_name = user_input($_POST['profile_name']);
    $password = user_input($_POST['password']);
    $re_password = user_input($_POST['re_password']);

    if (empty($email) || empty($profile_name) || empty($password) || empty($re_password)){
        $errors[] = 'ALL fields are required';
    }elseif(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
        $errors[] = 'Email is not valied';
    }elseif($password != $re_password){
        $errors[] = 'password is not match';
    }

    try{
        if(count($errors) == 0){

            $query = "INSERT INTO user(email,profile_name,password) VALUES ('$email','$profile_name','$password');";

            if (mysqli_query($connection,$query)){
                header("Location: login.php");

            }else{
                throw new Exception(mysqli_error($connection));
            }
        }
        }catch(Exception $e){
            echo $e->getMessage();
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
                        <lable>Profile Name</lable><br>
                        <lable>Password</lable><br>
                        <lable>Confirm Password</lable><br>
                    </div>
                    <div id="field">
                        <input type="email" name="email"><br>
                        <input type="text" name="profile_name"><br>
                        <input type="password" name="password"><br>
                        <input type="password" name="re_password"><br>
                    </div>
                </div>
                <button type="submit">Register</button>
                <button type="reset">Clear</button>
        </form>
    </div>

    <div id="footer"><h4><b>copyright@ setu.kln.ac.lk</b></h4></div>
<script src="js/home.js"></script>
</body>
</html>