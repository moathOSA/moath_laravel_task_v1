@extends('layouts.app')
@section('content')
<div class="w-50 m-auto text-center">
    <!-- Error Alert -->
    @if(!empty($errors->all()))
        <div class="alert myalert alert-danger alert-dismissible fade show">
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form method="POST" action="{{route('products.update',$product)}}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <input value="{{$product->name}}" type="text" name="name" class="form-control" id="name"  placeholder="Name" >
        </div>
        <div class="form-group">
            <input value="{{$product->description}}" name="description" type="text" class="form-control" id="description"  placeholder="description">
        </div>
        <div class="form-group">
            <input value="{{$product->quantity}}" name="quantity" type="text" class="form-control" id="quantity"  placeholder="quantity">
        </div>
        <div class="form-group">
            <input value="{{$product->price}}" name="price" type="text" class="form-control" id="price"  placeholder="price">
        </div>
    @if(!empty($product->image))
            <div class="form-group" id="image_delete">
                <div class="d-flex flex-column">
                    <div class="w-100 d-flex justify-content-start">
                        <div id="delete" class="btn btn-danger">Delete image</div>
                    </div>
                    <img class="w-100" src="{{asset('images/'.$product->image)}}" alt="">
                </div>
            </div>
        @endif
        <input type="hidden" id="secret" name="delete_image">
        <div class="form-group">
        <div class="input-group">
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
            </div>
        </div>
        </div>
        <div class="form-group">
            <select class="js-example-basic-multiple w-100" id="category"  name="category[]" multiple="multiple">
                <option id="FOP" value="" disabled hidden>Choose Category</option>
                @foreach($categories as $category)
                    <option
                        value="{{$category->id}}"
                        @if(in_array($category->id , $product_category))
                        selected
                        @endif>
                        {{$category->name}}
                    </option>

                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary d-flex justify-content-center m-auto">Submit</button>
    </form>
</div>

@endsection
