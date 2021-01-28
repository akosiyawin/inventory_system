<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request, CategoryService $service): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $service->store($request);
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    public function destroy(Category $category)
    {
        if($category->products->count() > 0){
            return response()->json([
                'message'=>'This category has an existing products.'
            ],400);
        }

        $category->delete();
        return response()->json([
            'message'=>'Category Deleted Successfully!'
        ]);
    }
}
