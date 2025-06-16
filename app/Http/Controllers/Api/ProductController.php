<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::latest()->cursorPaginate(10);
    }

    public function store(Request $request): Product
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        return Product::create($request->all());
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response()->noContent();
    }
}