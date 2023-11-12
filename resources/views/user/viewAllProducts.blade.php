@extends('user.layout')
@section('body')
   



<div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
                  <li data-filter=".des">Featured</li>
                  <li data-filter=".dev">Flash Deals</li>
                  <li data-filter=".gra">Last Minute</li>
              </ul>
            </div>
              @include('success')</div>
      
          <div class="col-md-12">
            <div class="filters-content">
                <div class="row grid">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-4 all des">
                      <div class="product-item">
                      <a href="{{ url('product/show/'.$product->id) }}"><img src="{{asset('storage/' . $product->image) }}" alt=""></a>
                        <div class="down-content">
                          <a href=""><h4>{{$product->name}}</h4></a>
                          <h6>{{$product->price}}</h6>
                          <p>{{$product->desc}}</p>
                          <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                          </ul>
                          <span>Reviews (12)</span>
                          <form action="{{url('addtocart/'.$product->id)}}" method="post">
                  @csrf
                  <label for="">quantity</label>
                <input type="number" name="qty" id="" value=1><br>
                <button type="submit" name="addtocart" class="btn btn-danger">Add To Cart</button>
                </form>
           
                        </div>
                      </div>
                    </div>
                    @endforeach
               
                </div>
            </div>
          </div>
      
          <div class="col-md-12">
            <ul class="pages">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>



@endsection