<?php

namespace App\Http\Api\Products;

use App\Http\Requests\Products\StoreProductTranslationRequest;
use App\Http\Resources\Products\ProductTranslationResource;
use App\Shop\Product\Database\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductTranslationsController extends Controller
{
    public function index(Request $request, Product $product): JsonResponse
    {
        return ProductTranslationResource::collection($product->translations)->toResponse($request);
    }

    public function show(Request $request, Product $product, string $locale): JsonResponse
    {
        return ProductTranslationResource::make($product->translateOrFail($locale))->toResponse($request);
    }

    public function store(StoreProductTranslationRequest $request, Product $product, string $locale): JsonResponse
    {
        $translation = $product->translateOrCreate($locale, $request->validated());

        return ProductTranslationResource::make($translation)->toResponse($request);
    }

    public function delete(Product $product, string $locale): JsonResponse
    {
        $product->translateOrFail($locale)->delete();

        return new JsonResponse(null, 204);
    }
}
