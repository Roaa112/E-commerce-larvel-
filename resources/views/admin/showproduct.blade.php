@extends('admin.layout')

@section('body')

<!-- <section style="background-color: #eee;"> -->
@include('../success')
<section style="background-color: transparent;">
  <div class="container py-5">

    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-10">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body">
          
            <div class="row">
          
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
             
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
              
                  <img
                    src="{{asset('storage/'.$product->image)}}"
                    class="w-100"
                  />
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
               
                </div>
               
              </div>
              
              <div class="col-md-6 col-lg-6 col-xl-6">
               
                <h5>{{$product->name}}</h5>
                <div class="d-flex flex-row">
                  <div class="text-danger mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <span>{{$product->quantity}}</span>
                </div>
                <div class="mt-1 mb-0 text-muted small">
                  <span>{{$product->category->name}}</span>
                </div>
                <p class="text-truncate mb-4 mb-md-0">
                  {{$product->desc}}
                </p>
              
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1">{{$product->price}}</h4>
                </div>
                <h6 class="text-success">Free shipping</h6>
                <div class="d-flex flex-column mt-4">
                  <!-- <button class="btn btn-primary btn-sm" type="button">Details</button>
                  <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    delete
                  </button> -->
                  
                  <a href="{{url('product/edit/'.$product->id)}}" class="btn btn-primary btn-sm">edit</a>
                  <a href="{{url('product/delete/'.$product->id)}}" class="btn btn-outline-primary btn-sm mt-2">Delete</a>
               
                </div>
               
              </div>
           
            </div>
           
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

@endsection