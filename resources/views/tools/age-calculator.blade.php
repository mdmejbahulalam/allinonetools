@extends('layouts.app')

@section('title', 'Age Calculator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Age Calculator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Age Calculator</h1>

            <div x-data="ageCalculator()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date of Birth</label>
                    <input
                        x-model="birthDate"
                        @change="calculate()"
                        type="date"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    />
                </div>

                <template x-if="age !== null">
                    <div class="grid grid-cols-3 gap-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <div class="text-center">
                            <p class="text-sm text-green-600 dark:text-green-400">Years</p>
                            <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="age.years"></p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-green-600 dark:text-green-400">Months</p>
                            <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="age.months"></p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-green-600 dark:text-green-400">Days</p>
                            <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="age.days"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
function ageCalculator() {
    return {
        birthDate: '',
        age: null,

        calculate() {
            if (!this.birthDate) {
                this.age = null;
                return;
            }

            const today = new Date();
            const birth = new Date(this.birthDate);

            let years = today.getFullYear() - birth.getFullYear();
            let months = today.getMonth() - birth.getMonth();
            let days = today.getDate() - birth.getDate();

            if (days < 0) {
                months--;
                const prevMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                days += prevMonth.getDate();
            }

            if (months < 0) {
                years--;
                months += 12;
            }

            this.age = { years, months, days };
        }
    }
}
</script>

<div x-data="ageCalculator()"></div>
@endsection
