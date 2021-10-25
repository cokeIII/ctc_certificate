<?php
require_once "connect.php";

function calAge($birthday)
{
    $birthDate = explode("/", $birthday);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2] - 543))) > date("md")
        ? ((date("Y") - ($birthDate[2] - 543)) - 1)
        : (date("Y") - ($birthDate[2] - 543)));
    $groupAge = "";
    if ($age >= 12 && $age <= 17) {
        $groupAge = "12-18";
    } else if ($age >= 18) {
        $groupAge = "18";
    } else if ($age < 12) {
        $groupAge = "<12";
    }
    return  $groupAge;
}

function calAgeNumber($birthday)
{
    $birthDate = explode("/", $birthday);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2] - 543))) > date("md")
        ? ((date("Y") - ($birthDate[2] - 543)) - 1)
        : (date("Y") - ($birthDate[2] - 543)));
    return  $age;
}

function calAgeV2($birthday)
{
    $birthDate = explode("/", $birthday);
    $bDate = $birthDate[0] . "-" . $birthDate[1] . "-" . ($birthDate[2] - 543);
    $today = date("Y-m-d");
    // Calculate the time difference between the two dates
    $diff = date_diff(date_create($bDate), date_create($today));
    // Get the age in years, months and days
    return [$diff->format('%y'), $diff->format('%m'), $diff->format('%d')];
}
function calAgeV3($birthday)
{
    $birthDate = explode("/", $birthday);
    $bDate = $birthDate[0] . "-" . $birthDate[1] . "-" . ($birthDate[2] - 543);
    $today = date("Y-m-d");
    // Calculate the time difference between the two dates
    $diff = date_diff(date_create($bDate), date_create($today));
    // Get the age in years, months and days
    if ($diff->format('%y') >= 18) {
        return  "18";
    } else {
        return "12-18";
    }
}

function DateThai($strDate)
{
    // $exDate = explode("/", $strDate);
    // $strDate = ($exDate[2]) . "-" . $exDate[1] . "-" . $exDate[0];
    $strYear = date("Y", strtotime($strDate))+543;
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
