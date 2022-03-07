<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormProductRequest;
use App\Models\CartProduct;
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
            'products' => Product::simplePaginate(3)
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
     * @param  \App\Http\Requests\FormProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::factory()->create($data);

        return $this->edit($product, 201);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data['product'] = $product;
        return response()->view('product', $data);
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
     * @param  \App\Http\Requests\FormProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(FormProductRequest $request, Product $product)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        CartProduct::product($product->id)->delete();
        $product->delete();

        return redirect('/products')->with('status', 'Product deleted');
    }
}
