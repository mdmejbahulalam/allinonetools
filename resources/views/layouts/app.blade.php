<!DOCTYPE html>
<html lang="en" x-data="{ dark: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Utility Tools') - Your Free Online Tool Suite</title>
    <meta name="description" content="@yield('meta_description', 'Free online utility tools for text conversion, formatting, encoding, and much more.')">
    <meta name="keywords" content="@yield('meta_keywords', 'tools, converters, formatters, generators')">
    <meta property="og:title" content="@yield('title', 'Utility Tools')">
    <meta property="og:description" content="@yield('meta_description', 'Free online utility tools')">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
    @stack('schema')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">
    <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                    🔧 Utility Tools
                </a>
                <div class="flex items-center gap-4">
                    <input
                        type="search"
                        id="search"
                        placeholder="Search tools..."
                        class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        x-on:keyup.debounce="searchTools($event)"
                    >
                    <button
                        @click="dark = !dark; localStorage.setItem('darkMode', dark)"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600"
                    >
                        <span x-show="!dark">🌙</span>
                        <span x-show="dark">☀️</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div id="search-results" class="hidden fixed top-20 left-4 right-4 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-lg max-h-96 overflow-y-auto z-40">
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700 mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="font-bold mb-4">About</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Your free online toolkit for text conversion, formatting, and utility tasks.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Categories</h3>
                    <ul class="text-sm space-y-2">
                        @foreach($categories ?? [] as $cat)
                        <li><a href="/category/{{ $cat->slug }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Legal</h3>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a></li>
                        <li><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-300 dark:border-gray-700 pt-8">
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">&copy; {{ date('Y') }} Utility Tools. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function searchTools(event) {
            const query = event.target.value;
            if (query.length < 2) {
                document.getElementById('search-results').classList.add('hidden');
                return;
            }

            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(r => r.json())
                .then(tools => {
                    const html = tools.map(t => `
                        <a href="/${t.slug}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">${t.title}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">${t.category.name}</div>
                        </a>
                    `).join('');
                    document.getElementById('search-results').innerHTML = html;
                    document.getElementById('search-results').classList.remove('hidden');
                })
                .catch(() => {
                    document.getElementById('search-results').classList.add('hidden');
                });
        }
    </script>
</body>
</html>
