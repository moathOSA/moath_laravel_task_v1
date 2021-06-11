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

        <form method="POST" action={{route('users.store')}}>
            @csrf
            <div class="form-group">
                <input type="text" name="full_name" class="form-control" id="name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary d-flex justify-content-center m-auto">Submit</button>
        </form>
    </div>
@endsection
