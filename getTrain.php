<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
$people_id = $_SESSION["people_id"];
require_once "connect.php";
require_once "function.php";
$sql = "select * from train t
inner join pass_users p on p.train_id = t.train_id
where p.people_id = '$people_id'
";
$res = mysqli_query($conn, $sql);
$data = array();
$i = 0;
$data["data"][$i]["no"] ="ไม่พบรายการอบรม";
$data["data"][$i]["train_name"] = "";
$data["data"][$i]["date"] = "";
$data["data"][$i]["btn_print"] = "";

while ($row = mysqli_fetch_assoc($res)) {
    $data["data"][$i]["no"] = $i + 1;
    $data["data"][$i]["train_name"] = $row["train_name"];
    $data["data"][$i]["date"] = DateThai($row["date_start"]) . " - " . DateThai($row["date_end"]);
    $data["data"][$i]["btn_print"] = '<button class="btn btn-success btnPrint" trainId="' . $row["train_id"] . '"><i class="fas fa-print"></i> พิมพ์</button>';
    $i++;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
