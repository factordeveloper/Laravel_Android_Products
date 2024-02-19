<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

public function createProduct(Request $request){
    $product = Product::create($request->all());
    return response()->json($product);
}

public function updateProduct(Request $request, $id){
    $product = Product::findOrFail($id);
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->description = $request->input('description');
    $product->save();

    $response["products"] = $product;
    $response["success"] = 1;

    return response()->json($response);
}

public function deleteProduct($id){
    $product = Product::findOrFail($id);
    $product->delete();

    return response()->json('Removed successfully.');
}

public function index(){
    $products = Product::all();
    $response["products"] = $products;
    $response["success"] = 1;

    return response()->json($response);
}

public function getProductById($id) {
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    return response()->json($product);
}


}
