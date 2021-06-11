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

        <form method="POST" action={{route('products.store')}}  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="name"  placeholder="Name">
            </div>
            <div class="form-group">
                <input name="description" type="text" class="form-control" id="description"  placeholder="description">
            </div>
            <div class="form-group">
                <input name="quantity" type="text" class="form-control" id="quantity"  placeholder="quantity">
            </div>
            <div class="form-group">
                <input name="price" type="text" class="form-control" id="price"  placeholder="price">
            </div>
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
                    <option value="" disabled selected hidden>Choose Category</option>
                @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary d-flex justify-content-center m-auto">Submit</button>
        </form>
    </div>
@endsection


