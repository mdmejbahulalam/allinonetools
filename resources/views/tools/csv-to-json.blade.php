@extends('layouts.app')

@section('title', 'CSV to JSON Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">CSV to JSON</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">CSV Input</h2>
                <textarea
                    x-model="input"
                    @input="convert()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="8"
                    placeholder="name,email&#10;john,john@example.com"
                ></textarea>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">JSON Output</h2>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white max-h-96 overflow-auto">
                    <code class="text-sm whitespace-pre-wrap" x-html="output"></code>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function csvToJson() {
    return {
        input: 'name,email\njohn,john@example.com',
        output: '[{"name":"john","email":"john@example.com"}]',

        convert() {
            const lines = this.input.trim().split('\n');
            if (lines.length < 2) {
                this.output = '[]';
                return;
            }

            const headers = lines[0].split(',').map(h => h.trim());
            const data = [];

            for (let i = 1; i < lines.length; i++) {
                const obj = {};
                const values = lines[i].split(',').map(v => v.trim());
                for (let j = 0; j < headers.length; j++) {
                    obj[headers[j]] = values[j] || '';
                }
                data.push(obj);
            }

            this.output = JSON.stringify(data, null, 2);
        }
    }
}
</script>

<div x-data="csvToJson()"></div>
@endsection
