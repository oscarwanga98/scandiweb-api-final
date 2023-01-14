<?php
//headers

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:DELETE");

include_once '../config/Database.php';
include_once '../model/Product.php';

//instnciate the data base and connect to it 
$database =new Database();
$db = $database->connect();

//instanciate blog post object 

$product=new Product($db);

//get the raw posted data
$data=json_decode(file_get_contents('php://input'));

// $data should come back with an array of values
//get array length
 $num=count($data);

//delete multiple posts
//error handling 
echo json_encode($data);

// looping as we delete each entry 
for ($i = 0; $i < $num; $i++) {
    $product->specialId=$data[$i];
   
    if($product->delete()){
        echo json_encode(
            array('message'=>'Product deleted')
        );
    }else{
        echo json_encode(
            array('message'=>'Product Not Deleted')
        );
    }
    
  }




