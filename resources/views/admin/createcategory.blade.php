@extends('admin.layout')


@section('body')
@include('../errors')
@include('../success')
<form method="POST" action="{{url('addcategory')}}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>




    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection