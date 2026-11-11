@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="page-head">
        <h1>Tambah User</h1>
    </div>

    <div class="card form-card">
        <form action="{{ route('users.store') }}" method="POST">
            @include('users._form')
        </form>
    </div>
@endsection