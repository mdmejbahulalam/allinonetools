@extends('layouts.app')

@section('title', 'Text Escape/Unescape - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Text Escape/Unescape</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Text Escape/Unescape</h1>

            <div x-data="textEscape()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Escape Type</label>
                    <select
                        x-model="escapeType"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="html">HTML Entities</option>
                        <option value="javascript">JavaScript</option>
                        <option value="url">URL Encoding</option>
                    </select>
                </div>

                <textarea
                    x-model="input"
                    @input="processText()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                    rows="6"
                    placeholder="Enter text..."
                ></textarea>

                <div class="flex gap-2">
                    <button @click="escapeText()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                        Escape
                    </button>
                    <button @click="unescapeText()" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                        Unescape
                    </button>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 font-mono text-sm break-all">
                    <code x-text="output || '(result will appear here)'"></code>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function textEscape() {
    return {
        input: '',
        output: '',
        escapeType: 'html',

        htmlEscape(str) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            };
            return str.replace(/[&<>"']/g, m => map[m]);
        },

        htmlUnescape(str) {
            const map = {
                '&amp;': '&',
                '&lt;': '<',
                '&gt;': '>',
                '&quot;': '"',
                '&#39;': "'",
                '&#x27;': "'"
            };
            return str.replace(/&amp;|&lt;|&gt;|&quot;|&#39;|&#x27;/g, m => map[m]);
        },

        jsEscape(str) {
            return str.replace(/\\/g, '\\\\').replace(/"/g, '\\"').replace(/'/g, "\\'").replace(/\n/g, '\\n').replace(/\r/g, '\\r').replace(/\t/g, '\\t');
        },

        jsUnescape(str) {
            return str.replace(/\\n/g, '\n').replace(/\\r/g, '\r').replace(/\\t/g, '\t').replace(/\\"/g, '"').replace(/\\'/g, "'").replace(/\\\\/g, '\\');
        },

        escapeText() {
            if (this.escapeType === 'html') {
                this.output = this.htmlEscape(this.input);
            } else if (this.escapeType === 'javascript') {
                this.output = this.jsEscape(this.input);
            } else if (this.escapeType === 'url') {
                this.output = encodeURIComponent(this.input);
            }
        },

        unescapeText() {
            if (this.escapeType === 'html') {
                this.output = this.htmlUnescape(this.input);
            } else if (this.escapeType === 'javascript') {
                this.output = this.jsUnescape(this.input);
            } else if (this.escapeType === 'url') {
                this.output = decodeURIComponent(this.input);
            }
        },

        processText() {
            this.output = '';
        }
    }
}
</script>

<div x-data="textEscape()"></div>
@endsection
