<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => env('APP_URL').'/'.$request->file('image')->store('images'),
            'price'       => $request->price
        ]);
        return response($product, Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
