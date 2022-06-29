<?php
require_once "connect.php";
$train_name = $_POST["train_name"];
$date_start = $_POST["date_start"];
$date_end = $_POST["date_end"];
$cer_min = $_POST["cer_min"];
$cer_max = $_POST["cer_max"];
$sql = "insert into train (
    train_name,
    date_start,
    date_end,
    cer_min,
    cer_max
    ) values(
        '$train_name',
        '$date_start',
        '$date_end',
        '$cer_min',
        '$cer_max'
    )";
$res = mysqli_query($conn,$sql);
if($res){
    header("manager.php");
}