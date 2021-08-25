<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pay your order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-session-status class="mb-4" :status="session('failed')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form action="{{ route('payment.store') }}" method="post">
                        @csrf

                        <!-- Order No. -->
                        <div>
                            <x-label for="order" :value="__('Order no.')" />

                            <x-input id="order" class="block mt-1 w-full" type="text" name="order" :value="old('order', $order)" required autofocus placeholder="Order no." />
                        </div>

                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Payment Now') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
