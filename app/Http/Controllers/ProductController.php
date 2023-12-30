<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductListAjax() {
        $products = Product::select('name')->get();
        $data = [];
      
        foreach ($products as $item) {
          $data[] = $item['name'];
        }
      
        return response()->json($data);
      }
      
}
