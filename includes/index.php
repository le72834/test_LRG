<?php 
include("connect.php");
include("functions.php");

//if we need one piece, run a get one function

//else get all the piece

if(isset($_GET["id"])){
    //get one item from the database - whichever one you clicked on and asked for in the UI
    $targetID = $_GET["id"];
    // $pdo is the connection object, because we need to access
    $result = getSingleUser($pdo, $targetID);

    return $result;
} else {
    // user must want to see all items in the database
    $allUsers = getAllUsers($pdo);

    return $allUsers;
}