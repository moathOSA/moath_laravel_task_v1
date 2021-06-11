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

    <form method="POST" action={{route('categories.update',$category)}}>
        @csrf
        @method('patch')
        <div class="form-group">
            <input value="{{$category->name}}" type="text" name="name" class="form-control" id="name"  placeholder="Name">
        </div>
        <button type="submit" class="btn btn-primary d-flex justify-content-center m-auto">Submit</button>
    </form>
</div>

@endsection
