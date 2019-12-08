<?php

namespace App\Http\Shopfront\Products;

use App\Http\Shopfront\Controller;
use App\Shop\Product\Database\Product;
use Illuminate\Contracts\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        return view('products.grid', ['products' => Product::paginate()]);
    }

    public function show(Product $product) : View
    {
        return view('products.page', ['product' => $product]);
    }
}
