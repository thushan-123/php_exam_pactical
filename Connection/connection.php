<?php 

error_reporting(E_ALL);
ini_set("display_errors",1);

$host = "127.0.0.1";
$username = "thush";
$password = "thush";
$database = "proj_1";

try {
    // connect to the database
    $connection = mysqli_connect($host, $username, $password, $database);

    //echo "connected successfully";

}catch(Exception $e){

    echo "ERROR". $e->getMessage();
}




?>