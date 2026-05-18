@extends('layouts.app')

@section('title', 'Admin Login - Utility Tools')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 text-center">Admin Portal</h1>
        <p class="text-gray-600 dark:text-gray-400 text-center mb-8">Sign in to manage tools and categories</p>

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                @foreach ($errors->all() as $error)
                    <p class="text-red-700 dark:text-red-400 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="admin@example.com"
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                />
            </div>

            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="h-4 w-4 text-blue-600 dark:text-blue-500 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded"
                />
                <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-2 rounded-lg transition duration-200"
            >
                Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-8">
            Not an admin? <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Go back home</a>
        </p>
    </div>
</div>
@endsection
