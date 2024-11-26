<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-md-auto gy-5">
            <form action="{{route("product.store")}}" method="post" id="product-form">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Quantity In Stock</label>
                    <input type="number" class="form-control" name="quantity" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Price Per Item</label>
                    <input type="number" step=".01"  class="form-control" name="price" id="exampleInputPassword1">
                </div>

                <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                <button id="cancel-btn" class="btn btn-danger d-none">Cancel</button>
            </form>
        </div>

        <div class="gy-5">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity In Stock</th>
                    <th scope="col">Price Per Item</th>
                    <th scope="col">Datetime Submitted</th>
                    <th scope="col">Total Value Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->date_time}}</td>
                        <td>{{$product->total_value}}</td>
                        <td><button  data-id="{{$product->id}}" data-name="{{$product->name}}" data-quantity="{{$product->quantity}}" data-price="{{$product->price}}" class="btn btn-primary float-sm-end edit-btn">Edit</button></td>
                    </tr>
                @endforeach

                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td  colspan="3"><b>Total</b></td>
                    <td><b>{{$total}}</b></td>
                    <td></td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('index.js')}}"></script>

</body>
</html>
