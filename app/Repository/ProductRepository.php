<?php 

namespace App\Repository;
use App\Models\Product;
class ProductRepository implements IProductRepository{
    
    public function getAllProducts(){
        return Product::all();
    }
    public function createProduct(array $data){
        Product::insert([
            'title' => $data['title'],
            'picture' => $data['picture'],
            'price' => $data['price'],
            'desc' => $data['desc'],
        ]);
    }
}

?>