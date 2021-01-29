<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }

    public function store(ProductCreateRequest $request)
    {
        $product = Product::create(Arr::collapse([$request->all(), ['image' => env('APP_URL').'/'.$request->file('image')->store('images')]]));
        return response($product, Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update(Arr::collapse([$request->all(), ['image' => env('APP_URL').'/'.$request->file('image')->store('images')]]));
        return response($product, Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
