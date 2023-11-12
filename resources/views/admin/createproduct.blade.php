@extends('admin.layout')


@section('body')
@include('../errors')
@include('../success')
<form method="POST" action="{{url('addproduct')}}" enctype="multipart/form-data">
    @csrf
   
    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc"></textarea>
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>

   


      <div class="form-group">
        <label for="exampleInputEmail1">product image</label>
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
  <label for="categorySelect">Category</label>
  <select name="category_id" class="form-control" id="categorySelect">
    <option value="">Select a category</option>
    @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
  </select>
</div>
     

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection