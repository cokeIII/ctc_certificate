<?php
require_once "connect.php";
$train_name = $_POST["train_name"];
$date_start = $_POST["date_start"];
$date_end = $_POST["date_end"];
$cer_min = $_POST["cer_min"];
$cer_max = $_POST["cer_max"];

$target_dir = "img/cer/";
$target_file = $target_dir . basename($_FILES["pic_cer"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file image already exists.";
    $uploadOk = 0;
}
// Check if image file is a actual image or fake image

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pic_cer"]["tmp_name"], $target_file)) {
        $sql = "insert into train (
            train_name,
            date_start,
            date_end,
            cer_min,
            cer_max,
            pic_cer
            ) values(
                '$train_name',
                '$date_start',
                '$date_end',
                '$cer_min',
                '$cer_max',
                '$target_file'
            )";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("location:manager.php");
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
