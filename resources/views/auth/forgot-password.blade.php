@extends('layouts.auth')

@section('title', 'Forgot password')

@section('content')

    <x-forms.auth-forms
        title="Forgot password"
        action="{{ route('forgot.handle') }}"
        method="POST"
    >
        @csrf
        <x-forms.text-input
            name="email"
            type="email"
            placeholder="E-mail"
            required="true"
            :isError="$errors->has('email')"
        />

        @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Send
        </x-forms.primary-button>

        <x-slot:socialAuth></x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold underline underline-offset-4">Login</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-forms>

@endsection
