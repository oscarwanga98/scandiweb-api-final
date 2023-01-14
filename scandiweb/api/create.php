<?php
//headers

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:POST");


include_once '../config/Database.php';
include_once '../model/Product.php';

//instnciate the data base and connect to it 
$database =new Database();
$db = $database->connect();

//instanciate blog post object 

$product=new Product($db);

//get the raw posted data
$data=json_decode(file_get_contents('php://input'));

$product ->specialId=$data->specialId;
$product ->skuId=$data->skuId;
$product ->name=$data->name;
$product ->price=$data->price;
$product ->productTypeId=$data->productTypeId;
$product ->weight=$data->weight;
$product ->height=$data->height;
$product ->length=$data->length;
$product ->width=$data->width;
$product ->size=$data->size;


//create post 
if($product->create()){
    echo json_encode(
        array('message'=>'Post Created')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not Created')
    );
}