<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('products_list', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('product_form');
    }

    /**
     * Store a newly created product in database.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::factory()->create($data);

        return $this->edit($product, 201);
    }

    /**
     * Show the form for editing the product.
     *
     * @param  \App\Models\Product  $product
     * @param  integer  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, int $status = 200)
    {
        $data['product'] = $product;
        return response()->view('product_form', $data, $status);
    }

    /**
     * Update the specified product in database.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->name = $data['name'];
        $product->price = $data['price'];

        if($product->isDirty())
            $product->save();

        return $this->edit($product, 201);
    }

    /**
     * Remove the specified product from database.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['status' => true]);
    }
}
