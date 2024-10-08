<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return "Product Controller - Article List";
    }

    public function detail($id)
    {
        return "Product Controller - Article Detail - $id";
    }
}
