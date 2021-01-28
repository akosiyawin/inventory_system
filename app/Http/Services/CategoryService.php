<?php


namespace App\Http\Services;






use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','unique:categories']
        ],[
            'title.unique' => 'Product name already exist'
        ]);

        $category = new Category();
        $category->setAttribute('title',$request->get('title'));
        $category->save();

        return CategoryResource::collection(Category::all());
    }
}
