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

    <form method="POST" action={{route('users.update',$user)}}>
        @csrf
        @method('patch')
        <div class="form-group">
            <input value="{{$user->full_name}}" type="text" name="full_name" class="form-control" id="name"  placeholder="Full_Name">
        </div>
        <div class="form-group">
            <input value="{{$user->email}}" name="email" type="email" class="form-control" id="email"  placeholder="Email">
        </div>
        <div class="form-group">
            <input value="" name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary d-flex justify-content-center m-auto">Submit</button>
    </form>
</div>

@endsection

