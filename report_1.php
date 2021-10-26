<?php
// Require composer autoload
date_default_timezone_set("Asia/Bangkok");
require_once 'vendor/autoload.php';
require_once 'vendor/mpdf/mpdf/mpdf.php';
require_once 'connect.php';
error_reporting(error_reporting() & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: text/html; charset=utf-8');

// เพิ่ม Font ให้กับ mPDF
$mpdf = new mPDF();
$mpdf->AddPage('L');
$mpdf->SetDisplayMode('fullwidth');
$mpdf->SetDisplayMode(100);
session_start();
date_default_timezone_set("asia/bangkok");
echo $train_id = $_POST["train_id"];
echo $people_name = $_SESSION["people_name"];
echo $people_id = $_SESSION["people_id"];

$sqlC = "select * from trained where train_id='$train_id' and train_code != '' and people_id = '$people_id'";
$resC = mysqli_query($conn, $sqlC);
$numC = mysqli_num_rows($resC);
$rowC = mysqli_fetch_array($resC);
echo  $numC;
if ($numC <= 0) {
    echo 1;
    $sqlT = "select * from train where train_id='$train_id'";
    $resT = mysqli_query($conn, $sqlT);
    $rowT = mysqli_fetch_array($resT);
    $cer_min = $rowT["cer_min"];
    $cer_max = $rowT["cer_max"];

    $sqlCode = "select max(train_code) as currentCode from trained where train_id='$train_id'";
    $resCode = mysqli_query($conn, $sqlCode);
    $rowCode = mysqli_fetch_array($resCode);
    echo "<br>".$rowCode["currentCode"]."<br>";
    if (empty($rowCode["currentCode"])) {
        echo 2;
        $train_code = $cer_min;
    } else {
        if ($rowCode["currentCode"] + 1 > $cer_max) {
            header("location:errPage.php?textErr=รหัสใบประกาศไม่ถูกต้อง หรือเต็มแล้ว ทำให้ไม่สามารถพิมพ์ได้");
        } else {
            $train_code = $rowCode["currentCode"] + 1;
        }
    }
    if(!empty($people_id) && !empty($train_code)){
        echo 3;
        $sqlIn = "insert into trained (train_id,train_code,people_id) value('$train_id','$train_code','$people_id')";
        mysqli_query($conn, $sqlIn);
        echo "<br>".$sqlIn;
    } else {
        header("location:errPage.php?textErr=กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else {
    $train_code = $rowC["train_code"];
}
function DateThai($strDate)
{
    $exDate = explode("/", $strDate);
    $strDate = ($exDate[2]) . "-" . $exDate[1] . "-" . $exDate[0];
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    // return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    return "$strDay $strMonthThai $strYear";
}
ob_start(); // Start get HTML code

?>


<!DOCTYPE html>
<html>

<head>
    <title>Certificate 1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/ovec-removebg.ico" />
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            
        }

        #cover {
            background-image: url("img/cer/report1.png");
            /* background-image-resize: 6; */
            background-size: cover;
        }

        .text {
            z-index: 2;
        }

        .name {
            font-size: 35px;
            color: #040A9E;
            text-align: center;
            margin-top: 27%;
            font-family: "kanit";
            /* font-weight: bold; */
        }

        .number {
            font-size: 24px;
            margin-top: -30%;
            margin-right: 5px;
            text-align: right;
            font-family: "thsarabun";
        }
    </style>
</head>

<body>
    <div id="cover" style="position: absolute; z-index:-1; left:0.5px; right: 0; top: 0; bottom: 0; width:100%; height:100%;">
        <div class="text name"><?php echo $people_name;?></div>
        <div class="number"><?php echo "เลขที่ ".$train_code."/10-2564";?></div>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$taget = "pdf/certificate_1.pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;
?>