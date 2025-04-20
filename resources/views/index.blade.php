@extends('layouts.app')

@section('content')
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @method('DELETE')
            @csrf

            <button type="submit">Logout</button>
        </form>
    @endauth
@endsection
