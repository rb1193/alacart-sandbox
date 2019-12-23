<?php

namespace App\Http\Api\Products;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Shopfront\Controller;
use App\Shop\Product\Database\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return ProductResource::collection(Product::paginate())->toResponse($request);
    }

    public function show(Request $request, Product $product): JsonResponse
    {
        return ProductResource::make($product)->toResponse($request);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return ProductResource::make($product)->toResponse($request);
    }
}
