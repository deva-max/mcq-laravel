@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
</div>
@endsection
