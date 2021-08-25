<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Success') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-3/10">
                        <div class="flex">
                            <div class="flex-grow">
                                <strong>Order no.</strong>
                            </div>
                            <div class="flex-none">
                                <p>{{ $product->id }}</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-grow">
                                <strong>Total</strong>
                            </div>
                            <div class="flex-none">
                                <p>{{ $product->total() }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            @if ($product->address)
                                <p>{{ $product->title }} that costs {{ $product->total }} will be shipped to:</p>
                                <p>{{ $product->address }}</p>
                                <p>only after you pay.</p>
                            @else
                                <p>Your mobile phone number {{ $product->title }} will receive {{ $product->price() }}</p>
                            @endif
                        </div>

                        <div class="flex items-center mt-4">
                            <x-link href="{{ route('payment') }}">
                                {{ __('Payment Now') }}
                            </x-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
