<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function ProductListAjax() {
    $products = Product::select('name', 'image')->get();
    $data = [];

    foreach ($products as $item) {
        $data[] = [
            'value' => $item->name,
            'image' => $item->image,
        ];
    }

    return response()->json($data);
}

public function Search(Request $request){

  $item = $request->search;
  // echo "$item";

  $product = DB::table('products')
              ->where('name','LIKE',"%$item%")
              ->get();

  return view('search',compact('product'));

  // return view('frontend.pages.product_details',compact('restaurent'));

} // End Method
      
}
