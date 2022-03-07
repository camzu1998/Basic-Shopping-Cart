<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cart</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@1.1.0/css/minstyle.io.css">
    </head>
    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <h3>Products in cart</h3>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row mt-2">
                <div class="col-3"></div>
                <div class="col-6">
                    @if (count($cart_products) > 0)
                        <table class="ms-table">
                            <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Qty</th>
                                <th>Price for unit</th>
                                <th>Total price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cart_products as $cart_product)
                                    <tr>
                                        <td><a href="/product/{{ $cart_product->product_id }}">{{ $cart_product->name }}</a></td>
                                        <td>{{ $cart_product->qty }}</td>
                                        <td>{{ $cart_product->price }} zł</td>
                                        <td>{{ $cart_product->price*$cart_product->qty }} zł</td>
                                        <td>
                                            <form action="/cart/{{ $cart_product->id }}" method="post">@method('DELETE')@csrf<button type="submit">X</button></form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Please add first some products to cart.</p>
                    @endif
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row mt-2">
                <div class="col-3"></div>
                <div class="col-6">
                    <p>Total cart price: {{ $total_value }} zł</p><br>
                    <a href="/products">Back to catalog</a>
                </div>
                <div class="col-3"></div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dark-mode-switcher@0.0.1/dist/dark.min.js"></script>
    </body>
</html>
