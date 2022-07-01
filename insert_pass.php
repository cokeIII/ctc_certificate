<?php
require_once "connect.php";
$train_id = $_POST["train_id"];
$people_id = $_POST["people_id"];
$sqlD = "delete from pass_users where train_id = '$train_id'";
mysqli_query($conn,$sqlD);
for ($i = 0; $i <= count($people_id) - 1; $i++) {
    $people = $people_id[$i];
    $sql = "replace into pass_users (train_id,people_id) values('$train_id','$people')";
    mysqli_query($conn, $sql);
}
header("location:manager.php");
