@extends('layouts.app')

@section('title', 'Mortgage Calculator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Mortgage Calculator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Mortgage Calculator</h1>

            <div x-data="mortgageCalculator()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Loan Amount: $<span x-text="principal.toFixed(0)"></span></label>
                    <input type="range" x-model.number="principal" @input="calculate()" min="10000" max="1000000" step="10000" class="w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Interest Rate (%): <span x-text="rate.toFixed(2)"></span></label>
                    <input type="range" x-model.number="rate" @input="calculate()" min="0.5" max="12" step="0.1" class="w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Loan Term (Years): <span x-text="years"></span></label>
                    <select x-model.number="years" @change="calculate()" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="5">5 Years</option>
                        <option value="10">10 Years</option>
                        <option value="15">15 Years</option>
                        <option value="20">20 Years</option>
                        <option value="30">30 Years</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <div>
                        <p class="text-sm text-blue-600 dark:text-blue-400">Monthly Payment</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300">$<span x-text="monthlyPayment.toFixed(2)"></span></p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600 dark:text-blue-400">Total Interest</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300">$<span x-text="totalInterest.toFixed(2)"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function mortgageCalculator() {
    return {
        principal: 300000,
        rate: 5.5,
        years: 30,
        monthlyPayment: 0,
        totalInterest: 0,

        calculate() {
            const monthlyRate = this.rate / 100 / 12;
            const numPayments = this.years * 12;

            if (monthlyRate === 0) {
                this.monthlyPayment = this.principal / numPayments;
            } else {
                this.monthlyPayment = (this.principal * monthlyRate * Math.pow(1 + monthlyRate, numPayments)) / (Math.pow(1 + monthlyRate, numPayments) - 1);
            }

            this.totalInterest = (this.monthlyPayment * numPayments) - this.principal;
        },

        init() {
            this.calculate();
        }
    }
}
</script>

<div x-data="mortgageCalculator()" x-init="init()"></div>
@endsection
