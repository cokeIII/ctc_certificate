<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$sql = "select * from train";
$res = mysqli_query($conn, $sql);
$data = array();
$i = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $data["data"][$i]["no"] = $i + 1;
    $data["data"][$i]["train_name"] = $row["train_name"];
    $data["data"][$i]["date"] = $row["date_start"] . "-" . $row["date_end"];
    $data["data"][$i]["btn_print"] = '<button class="btn btn-success btnPrint" trainId="' . $row["train_id"] . '"><i class="fas fa-print"></i> พิมพ์</button>';
    $i++;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
