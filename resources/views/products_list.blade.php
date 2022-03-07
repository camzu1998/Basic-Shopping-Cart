<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products list</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@1.1.0/css/minstyle.io.css">
    </head>
    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <h3>Products</h3>
                    <br>
                    <a href="/product" class="mr-4">Create product</a>
                    <a href="/cart" class="mx-2">Cart products list</a>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row mt-2">
                <div class="col-3"></div>
                <div class="col-6">
                    @if (count($products) > 0)
                        <table class="ms-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><a href="/product/{{ $product->id }}">{{ $product->name }}</a></td>
                                        <td>{{ $product->price }} zł</td>
                                        <td><a href="/product/{{ $product->id }}/edit">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="ms-pagination">
                            {{ $products }}
                        </div>
                    @else
                        <p>Sorry :(, we does not has any product</p>
                    @endif
                </div>
                <div class="col-3"></div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dark-mode-switcher@0.0.1/dist/dark.min.js"></script>
    </body>
</html>
