<?php


namespace App\Http\Services;


use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function store(Request $request)
    {
        $request->validate($this->validate());
        $product = new Product();
        $product->title = $request->get('title');
        $product->category_id = $request->get('category_id');
        $product->stock = $request->get('stock');
        $product->manufactured_date = $request->get('manufactured_date');
        $product->expiration_date = $request->get('expiration_date');
        $product->save();

        return ProductResource::make($product);
    }

    public function increase(Product $product)
    {
        if($product->stock < 999999999){
            $product->update(['stock'=>$product->stock+1]);
            return "success";
        }

        return response()->json(['message'=>'Error, Stock reached max limit'],400);
    }

    public function decrease(Product $product)
    {
        if($product->stock > 0){
            $product->update(['stock'=>$product->stock-1]);
            return "success";
        }

        return response()->json(['message'=>'Error, No more stock left'],400);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate($this->validate());
        $product->update($validated);
        return ProductResource::make($product);
    }

    private function validate(): array
    {
        return [
            'title' => ['required','max:255'],
            'category_id' => ['required','numeric','exists:categories,id'],
            'stock' => ['required','numeric','digits_between:1,9'],
            'manufactured_date' => ['required','date'],
            'expiration_date' => ['required','date','after:manufactured_date'],
        ];
    }
}
