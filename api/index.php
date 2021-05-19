<?php
//echo json_encode(explode("/",key($_GET)));

require_once "config.php";
require_once "func.php";
$func = new func();

$argc = explode("/", key($_GET));
$method = $argc[0];
$param = $argc[1];

$types = array('image/png', 'image/jpeg');
$size = 2097152;
$path = $_SERVER['DOCUMENT_ROOT'] . '/api/product_images/';
$error = [];

if (empty($method)) {
    echo 'Задан пустой запрос';
    exit;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
//        echo 'GET';

        break;
    case 'POST':
//        echo 'POST';
        switch ($method) {
            case 'auth':
                $login = $_POST['login'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM `user` WHERE `login`='$login' AND `password`='$password'";
                $result = $db->query($sql);
                if ($result && $result->num_rows > 0) {
//                    $row = $result->fetch_array();
//                    Здесь создать куки или что-то подобное
                    $func->response(200, 'text', ['status' => true, 'token' => "TOKENMUSTBEHERE"]);
                } else {
                    $func->response(401, 'Invalid authorization data', ["status" => false,
                        "message" => "Invalid authorization data",]);
                }
                break;
        }
        break;
    case 'DELETE':
//        echo 'DELETE';
    case 'product':
        if (!empty($param)) {
            $sql = "DELETE FROM `product` WHERE `product`.`id` = '$param'";
            $result = $db->query($sql);
            if ($result) {
                $func->response(201, 'Successful delete', ['status' => true]);
            } else {
                $func->response(404, 'Product not found', ['message' => 'Product not found']);
            }
        }
        break;
    default:
        echo "unknown request";
        break;
}





//echo "$method <br> $param<br>";

//print_r($_GET);

//$arr = array(
//    "status code" => 200,
//    "status text" => "Successful authorization",
//    "body" => array(
//        "status" => "true",
//        "token" => "TOKEN",
//    )
//);
//
//$arr = array(
//    "status code" => 401,
//    "status text" => "Invalid authorization data",
//    "body" => array(
//        "status" => "false",
//        "message" => "Invalid authorization data",
//    )
//);
//echo json_encode(array(("response") => $arr));
