<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IProductRepository;

class ProductController extends Controller
{
    public $product;
    public function __construct(IProductRepository $product){
        $this->product = $product;
    }
    public function index(){    
        $products = $this->product->getAllProducts();
        return view('product.index')->with('products', $products);
    }
    public function create(){
        return view('product.create');
    }
    public function store(Request $request){
        $request->validate([
            'picture' => 'required',
            'title' => 'required',
            'price' => 'required',
            'desc' => 'required',
        ]);
        $data = $request->all();
        if($image = $request->file('picture')){
            $name = time().".".$image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            $data['picture'] = $name;
        }
        $this->product->createProduct($data);
        return redirect('/products');
    }
}
