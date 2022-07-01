<?php 
require_once "connect.php";
$id = $_GET["trainId"];
$sql ="delete from train where train_id = '$id'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: manager.php");
}