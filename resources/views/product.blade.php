<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form action="{{ route('product.store') }}" method="post">
                        @csrf

                        <!-- Product -->
                        <div>
                            <x-label for="product" :value="__('Product')" />

                            <x-input id="product" class="block mt-1 w-full" type="text" name="product" :value="old('product')" required autofocus placeholder="Product" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-label for="address" :value="__('Address')" />

                            <x-textarea id="address" class="block mt-1 w-full" name="address" required autofocus placeholder="Address">
                                {{ old('address') }}
                            </x-textarea>
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus placeholder="Price" />
                        </div>

                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
