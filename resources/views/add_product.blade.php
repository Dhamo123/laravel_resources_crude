@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Product</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="panel-body">

            @if(isset($product))
            {{ Form::model($product,['route' => ['product.update',$product['id']], 'method' => 'put','files'=>'true','id'=>'prod_form','class'=>'createEditForm'])}}
            @else
            {{ Form::model($products,['route' => ['product.store'], 'method' => 'post','files'=>'true','id'=>'prod_form','class'=>'createEditForm'])}}
            @endif
            @csrf
            <div class="form-group">

              <label for="name">Product Name</label>
              {{ Form::text('name',null, ['class'=>'form-control','id'=>'name','placeholder' => 'Product Name']) }}
            </div>
            <div class="form-group">
              <label for="price">Quantity</label>
              {{ Form::text('qty',null, ['class'=>'form-control','id'=>'qty','placeholder' => 'Quantity Name']) }}
              
            </div>
            <div class="form-group">
              <label for="photo">Image</label>
              {{ Form::file('photo',null, ['class'=>'form-control','id'=>'photo']) }}
              @if(isset($product))
              {{ Form::hidden('old_photo',$product['photo']['photo'], ['class'=>'form-control']) }}
              <img src="../../product_images/{{$product['photo']['photo']}}" height="100" width="100">
              @endif
            </div>
            @if(!isset($product))
            <button type="submit" class="btn btn-primary">Add</button>
            @else
            <button type="submit" class="btn btn-primary">Update</button>
            @endif
            {{ Form::close()}}



          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection 




