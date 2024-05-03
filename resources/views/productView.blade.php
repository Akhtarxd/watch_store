@extends('layoutUser')
@section('content')
    <!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{$product->image}}" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{$product->product_code}}</div>
                <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">{{'₹'.$product->price}}</span>
                    <span> &nbsp;{{'₹'.$product->sale_price}}</span>
                </div>
                <p class="lead">{{$product->description}}</p>
                <div class="d-flex">
                    <form action="{{route('addToCart')}}" method="post">
                        @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input class="form-control text-center me-3" id="inputQuantity" name="quantity" min="1" type="num" value="1" style="max-width: 3rem" />
                    <input class="btn btn-outline-dark flex-shrink-0" type="submit" value="Add to Cart">
                        <!-- <i class="bi-cart-fill me-1"></i>
                        Add to Cart -->
                    </input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($Relatedproducts as $relatedProduct)
                
            
                <div class="col mb-5">
                    <div class="card h-100">
                        
                        <!-- Sale badge-->
                        @if(!empty($relatedProduct->sale_price) && $relatedProduct->stock != 0)
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                            </div>
                        @elseif($relatedProduct->stock == 0)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Out of stock
                            </div>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}"/>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$relatedProduct->name}}</h5>
                                <!-- Product price-->
                                @if(!empty($relatedProduct->sale_price) || $relatedProduct->sale_price == 0)
                                    <span class="text-muted text-decoration-line-through">{{'₹'.$product->price}}</span>
                                    {{'₹'.$relatedProduct->sale_price}}
                                @else
                                    {{'₹'.$relatedProduct->price}}
                                @endif
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('productInfo',['product'=>$product->id])}}">View Product</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View Product</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection