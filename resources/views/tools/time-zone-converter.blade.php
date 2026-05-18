@extends('layouts.app')

@section('title', 'Time Zone Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Time Zone Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Time Zone Converter</h1>

            <div x-data="timeZoneConverter()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Time</label>
                    <input
                        x-model="time"
                        type="time"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From Time Zone</label>
                        <select
                            x-model="fromTz"
                            @change="convert()"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                            <option value="UTC">UTC</option>
                            <option value="EST">EST (UTC-5)</option>
                            <option value="CST">CST (UTC-6)</option>
                            <option value="PST">PST (UTC-8)</option>
                            <option value="GMT">GMT (UTC)</option>
                            <option value="CET">CET (UTC+1)</option>
                            <option value="IST">IST (UTC+5:30)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To Time Zone</label>
                        <select
                            x-model="toTz"
                            @change="convert()"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                            <option value="UTC">UTC</option>
                            <option value="EST">EST (UTC-5)</option>
                            <option value="CST">CST (UTC-6)</option>
                            <option value="PST">PST (UTC-8)</option>
                            <option value="GMT">GMT (UTC)</option>
                            <option value="CET">CET (UTC+1)</option>
                            <option value="IST">IST (UTC+5:30)</option>
                        </select>
                    </div>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <p class="text-sm text-blue-600 dark:text-blue-400 mb-2">Converted Time</p>
                    <p class="text-3xl font-mono font-bold text-blue-900 dark:text-blue-300" x-text="convertedTime"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function timeZoneConverter() {
    return {
        time: '12:00',
        fromTz: 'UTC',
        toTz: 'EST',
        convertedTime: '',

        offsets: {
            'UTC': 0,
            'GMT': 0,
            'EST': -5,
            'CST': -6,
            'PST': -8,
            'CET': 1,
            'IST': 5.5
        },

        convert() {
            const [hours, minutes] = this.time.split(':').map(Number);
            const fromOffset = this.offsets[this.fromTz];
            const toOffset = this.offsets[this.toTz];
            const diff = toOffset - fromOffset;

            let convertedHours = (hours + diff) % 24;
            if (convertedHours < 0) convertedHours += 24;

            this.convertedTime = String(Math.floor(convertedHours)).padStart(2, '0') + ':' + String(minutes).padStart(2, '0');
        },

        init() {
            this.convert();
        }
    }
}
</script>

<div x-data="timeZoneConverter()" x-init="init()"></div>
@endsection
