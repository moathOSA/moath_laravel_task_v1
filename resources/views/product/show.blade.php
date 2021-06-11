@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center m-auto">
        <div class="card text-center" style="width: 25rem;">
            @if(!empty($product->image))
            <img class="card-img-top" src="{{asset('images/'.$product->image)}}" alt="Card image cap">
            @endif
            <div class="card-body">
                Name : <p class="card-title d-inline">{{$product->name}}</p><br>
                Description : <p class="card-text d-inline">{{$product->description ?? '---'}}</p><br>
                Quantity : <p class="card-text d-inline">{{$product->quantity}}</p><br>
                Price : <p class="card-text d-inline">{{$product->price}}</p><br>
            </div>
                <div class="d-flex justify-content-center w-100 m-auto">
                    <a  href="{{route('products.index')}}" type="button" class="btn btn-success mb-5">Back To Products</a>
                </div>

        </div>
    </div>

@endsection
