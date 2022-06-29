<?php
require_once "connect.php";
require_once "function.php";
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
header('Content-Type: text/html; charset=UTF-8');
if($username == "admin" && $password == "admin_cer"){
    $_SESSION["people_id"] = "1";
    $_SESSION["people_name"] = "admin";
    header("location:manager.php");
} else {
    $sql = "select * from people where people_id='$username'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    $numRow = mysqli_num_rows($res);
    if($password == "ctc_cer" && $numRow > 0){
        $_SESSION["people_id"] = $row["people_id"];
        $_SESSION["people_name"] = $row["people_name"]." ".$row["people_surname"];
        header("location:main.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
}
