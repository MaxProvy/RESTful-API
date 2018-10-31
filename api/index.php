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
            case 'product':
                $title = $_POST['title'];
                $manufacturer = $_POST['manufacturer'];
                $text = $_POST['text'];
                $tags = $_POST['tags'];
                // Проверяем тип файла
                if (!in_array($_FILES['picture']['type'], $types)) {
                    $error['image'] = 'Invalidfileformat';
                } else {
                    //Перемещаем в папку назначения с форматом
                    if (!move_uploaded_file($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])) {
                        $error['image'] = 'undefinederror';
                    } else {
                        $imagename = $_FILES['picture']['name'];
                        $sql = "INSERT INTO `product` (`title`, `manufacturer`, `text`, `tags`,`imagename`) VALUES
('$title', '$manufacturer', '$text', '$tags','$imagename')";
                        $result = $db->query($sql);
                    };
                };

                if ($result && empty($error)) {
                    $func->response(201, 'Successful', ['status' => true, 'post_id' => $db->insert_id]);
                } else {
                    if ($db->insert_id == 0) $error['title'] = 'already exists';
                    $func->response(400, 'Creating error', ['status' => false, "message" => $error]);
                }
                break;
        }
        break;
    case 'DELETE':
//        echo 'DELETE';

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