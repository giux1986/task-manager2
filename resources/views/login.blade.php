@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-medium mb-6">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="border border-gray-400 p-2 w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" class="border border-gray-400 p-2 w-full @error('password') border-red-500 @enderror" required>
                        @error('password')
                            <span class="text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-gray-700 ml-2">Remember me</label>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Login</button>

                    @if (Route::has('password.request'))
                        <a class="text-blue-500 hover:text-blue-700 ml-4" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
