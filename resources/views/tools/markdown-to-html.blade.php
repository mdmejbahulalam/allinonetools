@extends('layouts.app')

@section('title', 'Markdown to HTML Converter - ' . config('app.name'))
@section('meta_description', 'Convert Markdown text to HTML instantly. Perfect for web developers and content creators.')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white">Markdown to HTML</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Markdown to HTML</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Convert Markdown to HTML instantly</p>

                    <div x-data="markdownToHtml()" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Markdown Input</label>
                            <textarea
                                x-model="input"
                                @input="convert()"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono"
                                rows="8"
                                placeholder="# Heading&#10;&#10;**Bold text**&#10;&#10;- List item"
                            ></textarea>
                        </div>

                        <button @click="copyToClipboard()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                            Copy HTML
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">HTML Output</h2>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-300 dark:border-gray-600 max-h-96 overflow-auto">
                        <code class="text-gray-900 dark:text-white text-sm whitespace-pre-wrap break-words" x-html="output"></code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function markdownToHtml() {
    return {
        input: '# Heading\n\n**Bold text**\n\n- List item',
        output: '<h1>Heading</h1>\n<p><strong>Bold text</strong></p>\n<ul>\n<li>List item</li>\n</ul>',

        convert() {
            let md = this.input;
            let html = md
                .replace(/^### (.*?)$/gm, '<h3>$1</h3>')
                .replace(/^## (.*?)$/gm, '<h2>$1</h2>')
                .replace(/^# (.*?)$/gm, '<h1>$1</h1>')
                .replace(/^\* (.*?)$/gm, '<li>$1</li>')
                .replace(/(\n<li>.*<\/li>)/s, (m) => '<ul>' + m + '</ul>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/^\> (.*?)$/gm, '<blockquote>$1</blockquote>')
                .replace(/\n\n/g, '</p><p>')
                .replace(/^(?!<)(.+)$/gm, '<p>$1</p>')
                .replace(/<p><\/p>/g, '');

            this.output = html;
        },

        copyToClipboard() {
            navigator.clipboard.writeText(this.output);
            alert('HTML copied!');
        }
    }
}
</script>
@endsection
