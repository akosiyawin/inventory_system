<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request,ProductService $service)
    {
        return $service->store($request);
    }


    public function statistics()
    {
        $products = Product::all()->count();
        $stocks = Product::all()->sum('stock');
        $categories = Category::all()->count();
        return response()->json([
            'message' => 'Statistic access successfully!',
            'data' => [
                'products' => $products,
                'stocks' => $stocks,
                'categories' => $categories
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function edit(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @param ProductService $service
     * @return ProductResource
     */
    public function update(Request $request,Product $product,ProductService $service)
    {
        return $service->update($request,$product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product): \Illuminate\Http\Response
    {
        $product->delete();
        return response([
            'message'=>'Product deleted successfully!',
        ]);
    }

    public function increase(Product $product, ProductService $service)
    {
        return $service->increase($product);
    }

    public function decrease(Product $product, ProductService $service)
    {
        return $service->decrease($product);
    }
}
