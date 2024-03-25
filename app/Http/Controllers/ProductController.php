<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;

use App\Models\sections;
use App\Models\Product;



class ProductController extends Controller
{
   // ProductController methods
public function create() {
    $sections = sections::all();
    $products = Product::all();
    return view('products.create', compact('sections','products'));

}


public function store(StoreProductRequest $request) {
   // Validation passed, continue with storing the product
   $validatedData = $request->validated();

   // Create a new product with the validated data
   $product = new Product();
   $product->Product_name = $validatedData['Product_name'];
   $product->section_id = $validatedData['section_id'];
   $product->description = $validatedData['description'];
   $product->save();

   // Redirect back or to any other page as needed
   return redirect()->route('products.create');
}



public function update(Request $request)
{

   $id = sections::where('section_name', $request->section_name)->first()->id;

   $Products = Product::findOrFail($request->pro_id);

   $Products->update([
   'Product_name' => $request->Product_name,
   'description' => $request->description,
   'section_id' => $id,
   ]);

   session()->flash('Edit', 'تم تعديل المنتج بنجاح');
   return back();

}

public function destroy(Request $request)
{
     $Products = Product::findOrFail($request->pro_id);
     $Products->delete();
     session()->flash('delete', 'تم حذف المنتج بنجاح');
     return back();
}
}