@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        Welcome back saudara <strong>{{ auth()->user()->name }}</strong> happy nice day !
    </div>
</div>
@endsection