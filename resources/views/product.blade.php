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
                    <h3>{{ $product->name }} product card</h3>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row mt-2">
                <div class="col-3"></div>
                <form class="col-6" method="POST" action="/cart/{{ $product->id }}">
                    @csrf
                    <div class="ms-form-group">
                        <label for="qty">Qty</label>
                        <input type="number" placeholder="Qty" id="qty" name="qty" value="0" step="1">
                    </div>
                    <div class="ms-form-group"><button class="ms-btn ms-success ms-fullwidth ms-medium" type="submit">Add to cart</button></div>
                </form>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <a href="/products" class="mr-4">Back to catalog</a>
                    <a href="/cart" class="mx-2">Cart products list</a>
                </div>
                <div class="col-3"></div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dark-mode-switcher@0.0.1/dist/dark.min.js"></script>
    </body>
</html>
