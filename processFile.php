<?php
/**
 * Created by PhpStorm.
 * User: ma_sa
 * Date: 2018-03-24
 * Time: 05:59 PM
 */


require_once("classDatabaseManager.php");
require_once("classForm.php");
$form = new Form();

//$data = json_decode(file_get_contents("php://input"), true);


$data = [
//    'key1' => "its me \n",
//    'key2' => "how are You \n",
//    'key3' => "its correct \n",
    'key' => "ABCD"
];

function processMessages($data) {
    if (isset($data['key']) && $data['key'] === 'ABC') {
        if (isset($_POST["id"]) && isset($_POST["name"])) {
            $Id = $_POST["id"];
            $Name = $_POST["name"];

            $form = new Form();

            if ($form->createForm($Name)) {
                echo json_encode(array("status" => "success", "message" => "Data inserted successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Insert query failed with an error"));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Data is empty"));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Data is not set"));
    }
}


processMessages($data);















//function processMessages($data) {
//    $output = [];
//    foreach ($data as $key => $value) {
//
//
//        if ($key === 'key' && $value === 'ABC') {
//
//
//        } else {
//            $output[] = " [x] Running Value: $value";
//        }
//    }
//    return $output;
//}




