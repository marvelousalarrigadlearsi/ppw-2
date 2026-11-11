@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="page-head">
        <h1>Edit User</h1>
    </div>

    <div class="card form-card">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @method('PUT')
            @include('users._form')
        </form>
    </div>
@endsection