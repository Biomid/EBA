<?php

session_start();
require_once "functions.php";
$connect = dbConn();
date_default_timezone_set('Europe/Moscow');
$code = $_POST["code"];

$today = date("Y-m-d H:i:s");


$code2 = str_split($code);


function getLang($code, $connect, $today)
{
    $res;
    $arr = [
        "eng" => [],
        "ru" => []
    ];
    for ($i = 0; $i < count($code); $i++) {
        if ($code[$i] >= chr(65) && $code[$i] <= chr(90) || $code[$i] >= chr(97) && $code[$i] <= chr(122)) {
            array_push($arr['eng'], $i);
        } elseif ($code[$i] >= chr(192) && $code[$i] <= chr(255)) {
            array_push($arr['ru'], $i);
        }
    }
    if (count($arr['eng']) == 0) {
        $res = "OK";
    } elseif (count($arr['ru']) == 0) {
        $res = "OK";
    } elseif (count($arr['eng']) > count($arr['ru'])) {
        $res = preg_replace('/[АаВвЕеТМмНнХхКкСсуРрОо]/', '<span style="color: #dc3912">$0</span>', $code);
        $res = implode('', $res);

        $temp = implode('', $code);
        $insert_query = "INSERT INTO `confirmation_code` (`user_ip`, `code`,`time`) VALUE ('{$_SESSION["user_ip"]}','$temp','$today')";
        $data = $connect->prepare($insert_query);
        $data->execute();
    } elseif (count($arr['eng']) <= count($arr['ru'])) {
        $res = preg_replace('/[AaBCcEeHKkMmnOoPpTXx]/', '<span style="color: #dc3912">$0</span>', $code);
        $res = implode('', $res);

        $temp = implode('', $code);
        $insert_query = "INSERT INTO `confirmation_code` (`user_ip`, `code`,`time`) VALUE ('{$_SESSION["user_ip"]}','$temp','$today')";
        $data = $connect->prepare($insert_query);
        $data->execute();
    }
    return $res;
}

$res = getLang($code2, $connect, $today);

$response = [
    "mytext" => $code,
    "good" => $res
];
echo json_encode($response);
