@extends('layouts.app')

@section('title', 'Admin Dashboard - Utility Tools')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Admin Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h1>
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Tools</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_tools'] }}</p>
                    </div>
                    <div class="text-3xl text-blue-500 dark:text-blue-400">📦</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Categories</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_categories'] }}</p>
                    </div>
                    <div class="text-3xl text-purple-500 dark:text-purple-400">📂</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Active Tools</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['active_tools'] }}</p>
                    </div>
                    <div class="text-3xl text-green-500 dark:text-green-400">✅</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Views</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_views']) }}</p>
                    </div>
                    <div class="text-3xl text-orange-500 dark:text-orange-400">👁️</div>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
            <!-- Tools Management -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tools Management</h2>
                    <a href="{{ route('admin.tools.create') }}" class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-800 text-white px-4 py-2 rounded text-sm transition">
                        Add Tool
                    </a>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Manage all utility tools in the platform</p>
                    <a href="{{ route('admin.tools.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                        View all tools →
                    </a>
                </div>
            </div>

            <!-- Categories Management -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Categories Management</h2>
                    <a href="{{ route('admin.categories.create') }}" class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-800 text-white px-4 py-2 rounded text-sm transition">
                        Add Category
                    </a>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Manage tool categories and organize content</p>
                    <a href="{{ route('admin.categories.index') }}" class="text-green-600 dark:text-green-400 hover:underline font-medium">
                        View all categories →
                    </a>
                </div>
            </div>
        </div>

        <!-- Top Tools -->
        @if($topTools->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Top Tools by Views</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Views</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($topTools as $tool)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $tool->title }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $tool->views ?? 0 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $tool->status === 'active' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300' }}">
                                    {{ ucfirst($tool->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
