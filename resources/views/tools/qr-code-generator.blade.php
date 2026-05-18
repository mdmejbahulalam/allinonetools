@extends('layouts.app')

@section('title', 'QR Code Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">QR Code Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">QR Code Generator</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Generate QR codes for URLs, text, and more</p>

            <div x-data="qrGenerator()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Enter Text or URL</label>
                    <textarea
                        x-model="input"
                        @input="generateQR()"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        rows="4"
                        placeholder="Enter text, URL, or email..."
                    ></textarea>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg border border-gray-300 dark:border-gray-600 flex justify-center">
                    <img :src="qrCode" :alt="input" x-show="qrCode" class="w-64 h-64">
                    <p x-show="!qrCode" class="text-gray-500 dark:text-gray-400">Your QR code will appear here</p>
                </div>

                <button @click="downloadQR()" x-show="qrCode" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                    Download QR Code
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
function qrGenerator() {
    return {
        input: '',
        qrCode: '',

        generateQR() {
            if (!this.input.trim()) {
                this.qrCode = '';
                return;
            }

            const container = document.getElementById('qr-temp');
            if (container) container.remove();

            const temp = document.createElement('div');
            temp.id = 'qr-temp';
            temp.style.display = 'none';
            document.body.appendChild(temp);

            new QRCode(temp, {
                text: this.input,
                width: 256,
                height: 256
            });

            const img = temp.querySelector('img');
            if (img) {
                this.qrCode = img.src;
            }
        },

        downloadQR() {
            const a = document.createElement('a');
            a.href = this.qrCode;
            a.download = 'qrcode.png';
            a.click();
        }
    }
}
</script>
@endsection
