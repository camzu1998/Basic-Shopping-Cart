<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product form</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@1.1.0/css/minstyle.io.css">
        <style>
            *{
                box-sizing: border-box;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    @if(!empty($product))
                        <h3>Update {{ $product->name }} product</h3>
                    @else
                        <h3>Create new product</h3>
                    @endif
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row mt-2">
                <div class="col-3"></div>
                <form class="col-6" method="POST" action="@if(!empty($product))/product/{{ $product->id }}@else /product @endif">
                    @if(!empty($product))
                        @method('PUT')
                    @endif

                    @csrf
                    <div class="ms-form-group">
                        <label for="name">Product name</label>
                        <input type="text" placeholder="Product name" id="name" name="name" value="@if(!empty($product)){{ $product->name }}@endif">
                    </div>
                    <div class="ms-form-group">
                        <label for="price">Product price</label>
                        <input type="number" step="0.01" placeholder="Product price" name="price" id="price" value="@if(!empty($product)){{ $product->price }}@endif">
                    </div>

                    <div class="ms-form-group"><button class="ms-btn ms-success ms-fullwidth ms-medium" type="submit">Save</button></div>
                </form>
                <div class="col-3"></div>
            </div>

            @if(!empty($product))
                <div class="row">
                    <div class="col-3"></div>
                    <form class="col-6" method="post" action="/product/{{ $product->id }}">
                        @method('DELETE')
                        @csrf
                        <div class="ms-form-group"><button class="ms-btn ms-danger ms-fullwidth ms-medium" type="submit">Delete product</button></div>
                    </form>
                    <div class="col-3"></div>
                </div>
            @endif

            <div class="row my-4 justify-content-center">
                @if (session('status') != '')
                    <div class="ms-alert ms-success ms-text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="ms-alert ms-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <a href="/products" class="mr-4">Back to catalog</a>
                    <a href="/product" class="mx-2">Create another product</a>
                </div>
                <div class="col-3"></div>
            </div>

        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dark-mode-switcher@0.0.1/dist/dark.min.js"></script>
    </body>
</html>
