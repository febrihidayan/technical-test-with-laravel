<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prepaid Balance') }}
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

                    <form action="{{ route('prepaid-balance.store') }}" method="post">
                        @csrf

                        <!-- Mobile Number -->
                        <div>
                            <x-label for="number" :value="__('Mobile Number')" />

                            <x-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number')" required autofocus placeholder="Mobile Number" />
                        </div>

                        <!-- Value -->
                        <div class="mt-4">
                            <x-label for="value" :value="__('Value')" />

                            <x-select id="value" name="value" required>
                                <option hidden>{{ old('value', 'Select value') }}</option>
                                <option value="10000">10.000</option>
                                <option value="50000">50.000</option>
                                <option value="100000">100.000</option>
                            </x-select>
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
