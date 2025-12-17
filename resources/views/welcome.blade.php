@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container" style="margin-top: 200px">
    <form action="{{ route('authors.index') }}" method="POST">
        @csrf
        <input class="form-control" type="text" name="name" id="">
        <input class="form-control mt-2" type="text" name="last_name" id="">
        <button class="mt-2 btn btn-primary">SAVE</button>
    </form>
</div>

@endsection
