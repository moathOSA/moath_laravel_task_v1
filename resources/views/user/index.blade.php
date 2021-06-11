@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-start w-100 m-auto">
        <a  href="{{route('users.create')}}" type="button" class="btn btn-success mb-5">Create User</a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->full_name}}</td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center m-auto">
                        <a class="font-weight-bolder" href="{{route('users.edit',$user)}}"><span><i
                                    class="fas fa-pen text-dark"></i></span></a>
                        <form class="m-0" action="{{route('users.destroy',$user)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            @if(empty($user->products->count()))
                            <button class="fa fa-trash btn " type="submit"
                                    onclick="return confirm('Are you sure?')"></button>
                            @else
                                <span class="fa fa-trash btn border-0"
                                      onclick="return alert('you can not delete this user because he own products!')">
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
            {!! $users->links() !!}
        </div>
    </div>
@endsection
