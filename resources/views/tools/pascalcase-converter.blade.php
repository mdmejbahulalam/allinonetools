@extends('layouts.app')

@section('title', 'PascalCase Converter - Convert Text Format')
@section('meta_description', 'Convert text to PascalCase format instantly. Free online text case converter.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">PascalCase Converter</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">PascalCase Converter</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Convert text to PascalCase format instantly.</p>

        <div x-data="caseConverter('pascal')" class="space-y-6">
            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Original Text</label>
                <textarea
                    x-model="input"
                    @input="convert()"
                    placeholder="Enter text (spaces, hyphens, underscores, or camelCase)..."
                    class="w-full h-32 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2 flex gap-2">
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Reset</button>
                    <button @click="loadExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
                </div>
            </div>

            <!-- Output Area -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block font-semibold">PascalCase Output</label>
                    <button @click="copyOutput()" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                        📋 Copy
                    </button>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg font-mono text-sm min-h-12 break-all">
                    <span x-text="output"></span>
                </div>
            </div>

            <!-- Other Formats Preview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                    <div class="text-xs text-gray-600 dark:text-gray-400 mb-2">camelCase</div>
                    <div class="font-mono text-sm break-all" x-text="toCamelCase()"></div>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                    <div class="text-xs text-gray-600 dark:text-gray-400 mb-2">snake_case</div>
                    <div class="font-mono text-sm break-all" x-text="toSnakeCase()"></div>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                    <div class="text-xs text-gray-600 dark:text-gray-400 mb-2">kebab-case</div>
                    <div class="font-mono text-sm break-all" x-text="toKebabCase()"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">What is PascalCase?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">PascalCase (also called UpperCamelCase) is a naming convention where each word starts with an uppercase letter and there are no separators. Example:</p>
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded font-mono text-sm">MyVariableName<br>GetUserById<br>CalculateTotalPrice
                </div>
                <p class="text-gray-600 dark:text-gray-400 mt-4">It's commonly used for class names, types, and interfaces in many programming languages.</p>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Use Cases</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Class names in Java, C#, Python</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Component names in React/Vue</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Type and interface names</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Namespace and enum names</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Case Converters</h3>
            <div class="space-y-2">
                <a href="/camelcase-converter" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">camelCase</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Convert to camelCase</div>
                </a>
                <a href="/snake-case-converter" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">snake_case</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Convert to snake_case</div>
                </a>
            </div>
        </div>
    </aside>
</div>

<script>
function caseConverter(type) {
    return {
        input: '',
        output: '',
        caseType: type,

        convert() {
            const words = this.input
                .replace(/([A-Z])/g, ' $1')
                .replace(/[-_\s]+/g, ' ')
                .trim()
                .split(/\s+/)
                .filter(w => w);

            if (this.caseType === 'pascal') {
                this.output = words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
            }
        },

        toCamelCase() {
            const words = this.input.replace(/([A-Z])/g, ' $1').replace(/[-_\s]+/g, ' ').trim().split(/\s+/).filter(w => w);
            return words.map((w, i) => i === 0 ? w.toLowerCase() : w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
        },

        toSnakeCase() {
            const words = this.input.replace(/([A-Z])/g, ' $1').replace(/[-_\s]+/g, ' ').trim().split(/\s+/).filter(w => w);
            return words.map(w => w.toLowerCase()).join('_');
        },

        toPascalCase() {
            const words = this.input.replace(/([A-Z])/g, ' $1').replace(/[-_\s]+/g, ' ').trim().split(/\s+/).filter(w => w);
            return words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
        },

        toKebabCase() {
            const words = this.input.replace(/([A-Z])/g, ' $1').replace(/[-_\s]+/g, ' ').trim().split(/\s+/).filter(w => w);
            return words.map(w => w.toLowerCase()).join('-');
        },

        reset() {
            this.input = '';
            this.output = '';
        },

        loadExample() {
            this.input = 'my variable name';
            this.convert();
        },

        copyOutput() {
            navigator.clipboard.writeText(this.output).then(() => {
                alert('Copied to clipboard!');
            });
        }
    };
}
</script>
@endsection
