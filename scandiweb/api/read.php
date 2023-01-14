<?php
//headers

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header('Accesss-Control-Origin:*');
header('Content-Type:application/json');

include_once '../config/Database.php';
include_once '../model/Product.php';

//instnciate the data base and connect to it 
$database =new Database();
$db = $database->connect();

//instanciate blog post object 

$product=new Product($db);

//Blog Post query
$result=$product->read();
//row count 
$num=$result->rowCount();

//check if any post
if ($num>0){
    $product_arry['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        error_reporting(0);
        $product_item=array(
           'specialId'=>$specialId,
           'skuId'=>$skuId,
           'name'=>$name,
           'price'=>$price,
           'productType'=>$productTypeId,
           'weight'=>$weight,
           'length'=>$length,
           'width'=>$width,
           'height'=>$height,
           'size'=>$size,
        );
        //push to 'data'
        array_push($product_arry['data'],$product_item);
   }
   //turn to json
   echo json_encode($product_arry);
}else{
    echo json_encode(
        array('message'=>'No Post found')
    );
}