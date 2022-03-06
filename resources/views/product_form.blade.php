<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product form</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@1.1.0/css/minstyle.io.css">
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
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dark-mode-switcher@0.0.1/dist/dark.min.js"></script>
    </body>
</html>
