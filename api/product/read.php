<?php

$stmt = $product->read();
$num = $stmt->rowCount();
  
//checa se o n° encontrado é 0
if($num>0){
  
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );
  
        array_push($products_arr["records"], $product_item);
    }
  
    http_response_code(200);
  
    echo json_encode($products_arr);
}

else {
    http_response_code(404);

    //retorna q nao foi encontrado
    echo json_encode(
        array("message" => "No products found.")
    );  
}    

?>