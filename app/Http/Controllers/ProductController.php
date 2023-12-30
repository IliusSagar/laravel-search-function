<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
      
}
