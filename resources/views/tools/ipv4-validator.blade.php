@extends('layouts.app')

@section('title', 'IPv4 Validator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">IPv4 Validator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">IPv4 Validator</h1>

            <div x-data="ipValidator()" class="space-y-6">
                <input
                    x-model="ip"
                    @input="validate()"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="Enter IP address (e.g., 192.168.1.1)..."
                />

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span x-show="isValid" class="text-2xl">✓</span>
                        <span x-show="!isValid && ip" class="text-2xl">✗</span>
                        <span :class="isValid && ip ? 'text-green-600 dark:text-green-400' : !isValid && ip ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400'" x-text="status"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function ipValidator() {
    return {
        ip: '',
        isValid: false,
        status: 'Enter an IP address to validate',

        validate() {
            const regex = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
            this.isValid = regex.test(this.ip);

            if (!this.ip) {
                this.status = 'Enter an IP address to validate';
            } else if (this.isValid) {
                this.status = 'Valid IPv4 address';
            } else {
                this.status = 'Invalid IPv4 address';
            }
        }
    }
}
</script>

<div x-data="ipValidator()"></div>
@endsection
