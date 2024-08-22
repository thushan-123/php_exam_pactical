<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);
include_once ("../Connection/connection.php");


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

if (isset($_POST["submit_btn"])){

    $friend_id = (int) $_POST['id'];
    $user_id = (int) $_SESSION['user']['id'];
    try{

        $query = "DELETE FROM friends WHERE friend_id=$friend_id;";
        mysqli_query($connection,$query);

    }catch(Exception $e){
        echo $e->getMessage() ;
    }
}

$page = 1;

if (isset($_GET["pages"])){
    $page = (int) $_GET["pages"];
}

$page_no_recodes = 5 ;

// get the total raws in user table

$query = "SELECT COUNT(*) AS total_raw FROM user;";

$result = mysqli_query($connection,$query);

$total_raw = (int) mysqli_fetch_assoc($result)["total_raw"];

$start = ($page-1) * $page_no_recodes;

$user_id = (int) $_SESSION['user']['id'];

$query = "SELECT * FROM user WHERE NOT id=$user_id AND id  IN (SELECT friend_id FROM friends WHERE user_id=$user_id ) LIMIT $start , $page_no_recodes;";

$result_set = mysqli_query($connection,$query);

function total_number_of_friend($user_id, $connection){
    $user_id = (int) $user_id;
    $query = "SELECT count(*) AS total FROM friends WHERE user_id=$user_id;";
    $result_set = mysqli_query($connection,$query);
    $total =(int) mysqli_fetch_assoc($result_set)["total"];
    return $total;
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
    function addFriend(){
        window.location.href = "./addFriend.php";
    }
</script>

</head>
<body>

    <div id="header"><h2> My friend system</h2></div>

    <div id="container">
        <h4><?php echo $_SESSION['user']['profile_name'] ?>'s Add Friend Page</h4> <br/>
        <p>total number of friend : <?php echo total_number_of_friend($_SESSION['user']['id'],$connection);  ?></p> <br/>
        <table border="1">
            <?php
                
                if (mysqli_num_rows($result_set) > 0){
                    while($row = mysqli_fetch_assoc($result_set)){
                        $id = $row['id'];
                        $profile_name = $row['profile_name'];

                        echo "
                            <tr>
                                <td> $profile_name </td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <button type='submit' name='submit_btn'>unfriend</button>
                                    </form>

                                </td>
                                </tr>
                        
                        ";
                        
                    }
                }

                // calculate total number of page

                $total_pages = ceil($total_raw / $page_no_recodes);

                // show previous lik in page
                if($page > 1){
                    $previous = $page - 1;
                    echo "<a href='?pages=$previous'> previous</a>";
                }

                if($page< $total_pages){
                    $next = $page + 1;
                    echo "<a href='?pages=$next'> next </a>";
                }




            ?>



        </table>



        <div id="buttons">
            <button type="button" id="button2" onclick = "addFriend()"> Add Friend</button>

            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <button type="submit" id="button2" name="submit">Logout</button>
            </form>

        </div>
        
        
    </div>

    <div id="footer"><h4><b>copyright@ setu.kln.ac.lk</b></h4></div>

</body>
</html>