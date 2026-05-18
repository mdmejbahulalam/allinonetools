@extends('layouts.app')

@section('title', 'Character Code Table - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Character Code Table</span>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Character Code Table</h1>

            <div x-data="characterTable()" class="space-y-6">
                <input
                    x-model="search"
                    @input="filterTable()"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="Search character or code..."
                />

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-300 dark:border-gray-600">
                                <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Character</th>
                                <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Decimal</th>
                                <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Hex</th>
                                <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Binary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="item in filtered" :key="item.decimal">
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2 text-gray-900 dark:text-white font-mono" x-text="item.char"></td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white font-mono" x-text="item.decimal"></td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white font-mono" x-text="item.hex"></td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white font-mono text-xs" x-text="item.binary"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">Showing <span x-text="filtered.length"></span> of <span x-text="characters.length"></span> characters</p>
            </div>
        </div>
    </div>
</div>

<script>
function characterTable() {
    return {
        search: '',
        characters: [],
        filtered: [],

        init() {
            for (let i = 32; i <= 126; i++) {
                this.characters.push({
                    char: String.fromCharCode(i),
                    decimal: i,
                    hex: '0x' + i.toString(16).toUpperCase().padStart(2, '0'),
                    binary: i.toString(2).padStart(8, '0')
                });
            }
            this.filterTable();
        },

        filterTable() {
            const search = this.search.toLowerCase();
            this.filtered = this.characters.filter(item =>
                item.char.toLowerCase().includes(search) ||
                item.decimal.toString().includes(search) ||
                item.hex.toLowerCase().includes(search.toLowerCase())
            );
        }
    }
}
</script>

<div x-data="characterTable()" x-init="init()"></div>
@endsection
