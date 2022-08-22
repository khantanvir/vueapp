<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Product::all();
        return response()->json($data,200);
    }
}
