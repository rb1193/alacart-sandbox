<?php

namespace App\Http\Api\Products;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Shop\Product\Database\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    public function delete(Product $product): JsonResponse
    {
        $product->delete();

        return new JsonResponse(null, 204);
    }
}
