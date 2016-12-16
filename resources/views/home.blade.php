<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Products</h1>
    <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>
    <div id="products" class="row list-group">
        @if(count('products')>0)
        @foreach($products as $item)
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading">{{$item->name}}</h4>
                    <p class="list-group-item-text">{{$item->description}}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead">{{Helper::product_price($item->price)}}</p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="{{url('mua-hang',[$item->id,Helper::convert2Alias($item->name)])}}">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p>Product(s) not found.....</p>
        @endif
    </div>
</div>
</body>
</html>