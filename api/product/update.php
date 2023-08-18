<?php

//EX: http://localhost/js/api/product/read_one.php?id=106

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

if($product->update()) {

    http_response_code(200);

    echo json_encode(array("message" => "Foi atualizado com sucesso"));
}

else {
    http_response_code(503);

    echo json_encode(array("message" => "Não foi possivel "));
}

?>