<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
require_once "function.php";
$sql = "select * from train";
$res = mysqli_query($conn, $sql);
$data = array();
$i = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $data["data"][$i]["no"] = $i + 1;
    $data["data"][$i]["train_name"] = $row["train_name"];
    $data["data"][$i]["date"] = DateThai($row["date_start"]) . " - " . DateThai($row["date_end"]);
    $data["data"][$i]["btn_set"] = '<button class="btn btn-warning btnSet" trainId="' . $row["train_id"] . '" data-bs-toggle="modal" data-bs-target="#passUsers"><i class="fas fa-tools"></i> ตั้งค่ารายชื่อ</button>';
    $data["data"][$i]["btn_del"] = '<button class="btn btn-danger btnDel" trainId="' . $row["train_id"] . '"><i class="fas fa-trash-alt"></i> ลบ</button>';
    $i++;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
