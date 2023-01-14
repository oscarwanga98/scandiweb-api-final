<?php
class Product{
    //database
    private $conn;
    private $table='product';
    //Products properties 
    public $specialId;
    public $skuId;
    public $name;
    public $price;
    public $productTypeId;    
    public $weight;
    public $size;
    public $length;
    public $width;
    public $height;

    //constructor
    public function __construct($db){
        $this->conn=$db;
    }

    //functions 
    //get products 
    public function read(){

        //query
        $query='SELECT 
                    * 
                FROM 
                    product ';

        // prepapre statetment 
        $stmt=$this->conn->prepare($query);
       
        //execute the query 
        $stmt->execute();

        return $stmt;
    }
    //create prodcut 

    public function create(){
        
        $query='INSERT INTO '.$this->table.' 
            SET 
                specialId=:specialId, 
                skuId=:skuId, 
                name=:name, 
                price=:price, 
                productTypeId=:productTypeId, 
                weight=:weight, 
                height=:height, 
                length=:length, 
                width=:width, 
                size=:size 
            ';
        //prepare statement 
         $stmt =$this->conn->prepare($query);

        //clean data

        $this->specialId=htmlspecialchars(strip_tags($this->specialId));
        $this->skuId=htmlspecialchars(strip_tags($this->skuId));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->productTypeId=htmlspecialchars(strip_tags($this->productTypeId));
        $this->weight=htmlspecialchars(strip_tags($this->weight));
        $this->height=htmlspecialchars(strip_tags($this->height));
        $this->length=htmlspecialchars(strip_tags($this->length));
        $this->width=htmlspecialchars(strip_tags($this->width));
        $this->size=htmlspecialchars(strip_tags($this->size));

        //bind data

        $stmt->bindParam(':specialId',$this->specialId);
        $stmt->bindParam(':skuId',$this->skuId);
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':productTypeId',$this->productTypeId);
        $stmt->bindParam(':weight',$this->weight);
        $stmt->bindParam(':height',$this->height);
        $stmt->bindParam(':length',$this->length);
        $stmt->bindParam(':width',$this->width);
        $stmt->bindParam(':size',$this->size);

        //execute
        if($stmt->execute()){
            return true;
        }
        // /print error if something goes wrong
        printf('error:%s.\n',$stmt->error);
        return false;
    }

        //delete post

    public function delete(){

        //create query

        $query='DELETE FROM '.$this->table.' WHERE specialId=:specialId';

        //prepare statement 
        $stmt=$this->conn->prepare($query);
        //clean data
        $this->specialId=htmlspecialchars(strip_tags($this->specialId));
        //bind data
        $stmt->bindParam(':specialId',$this->specialId);

        //execute
        if($stmt->execute()){
            return true;
        }
        // /print error if something goes wrong
        printf('error:%s.\n',$stmt->error);
        return false; 

}


}
?>