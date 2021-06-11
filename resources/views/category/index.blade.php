@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-start w-100 m-auto">
        <a  href="{{route('categories.create')}}" type="button" class="btn btn-success mb-5">Create Category</a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Total Products</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    {{$category->products->count()}}
                </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center m-auto">
                        <a class="font-weight-bolder" href="{{route('categories.edit',$category)}}">
                            <span><i class="fas fa-pen text-dark"></i></span></a>
                        <form class="m-0" action="{{route('categories.destroy',$category)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            @if(empty($category->products->count()))
                            <button class="fa fa-trash btn border-0" type="submit"
                                    onclick="return confirm('Are you sure?')">
                            </button>
                            @else
                                <span class="fa fa-trash btn border-0"
                                        onclick="return alert('you can not delete this category because there is products related to it!')">
                                </span>
                            @endif
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <div class="d-flex justify-content-end">
            {!!$categories->links() !!}
        </div>
    </div>

@endsection
