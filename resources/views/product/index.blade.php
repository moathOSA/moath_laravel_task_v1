@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-start w-100 m-auto">
        <a  href="{{route('products.create')}}" type="button" class="btn btn-success mb-5">Create Product</a>
    </div>
        <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Owner</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><a href="{{route('products.show',$product)}}">{{$product->name}}</a></td>
                <td>
                    @if(!empty($product->description))
                        {{$product->description}}
                    @else
                        ---
                    @endif
                </td>
                <td>
                    {{$product->user->full_name}}
                </td>
                <td>
                    @foreach($product->categories as $category)
                        {{$category->name}} <br>
                    @endforeach
                </td>
                <td>
                    @if(!empty($product->quantity))
                        {{$product->quantity}}
                    @else
                        ---
                    @endif
                </td>
                <td>
                    @if(!empty($product->price))
                        {{$product->price}}
                    @else
                        ---
                    @endif
                </td>
                <td class="w-25">
                    @if(!empty($product->image))
                        <img class="img-thumbnail img-fluid" src="{{asset('images/'.$product->image)}}" alt="">
                    @else
                        ---
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center m-auto">

                        <form class="m-0" action="{{route('product.minus',$product)}}" method="post">
                            @csrf
                            @method('patch')
                            <button  @if($product->quantity == 1) disabled @endif class="fas fa-minus btn" type="submit"></button>
                        </form>
                        <form class="m-0" action="{{route('product.plus',$product)}}" method="post">
                            @csrf
                            @method('patch')
                            <button class="fas fa-plus btn" type="submit"></button>
                        </form>

                        <a class="font-weight-bolder" href="{{route('products.edit',$product)}}"><span><i
                                    class="fas fa-pen text-dark"></i></span></a>
                        <form class="m-0" action="{{route('products.destroy',$product)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="fa fa-trash btn " type="submit"
                                    onclick="return confirm('Are you sure?')"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <div class="d-flex justify-content-end">
            {!!$products->links() !!}
        </div>
    </div>
@endsection

