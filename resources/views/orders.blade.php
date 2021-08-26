<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-session-status class="mb-4" :status="session('failed')" />

                    <!-- search order no. -->
                    <form action="" method="get">
                        <x-input class="block mt-1 w-full" type="search" name="search" :value="old('search', request('search'))" autofocus placeholder="Search by Order no." />
                    </form>

                    <div class="my-4 divide-y">
                        @foreach ($products as $key => $item)
                            <div class="flex hover:bg-gray-50 cursor-pointer p-2">
                                <div class="flex-grow">
                                    <p>{{ $item->id }} ({{ $item->total() }})</p>
                                    @if ($item->address)
                                        <b>{{ $item->title }} that costs {{ $item->price() }}</b>
                                    @else
                                        <b>{{ $item->price() }} for {{ $item->title }}</b>
                                    @endif
                                </div>
                                <div class="flex-none my-auto">
                                    @if ($item->statusPayment() && $item->payment_status === $item::UNPAID && $item->status === $item::CREATED)

                                        <x-link href="{{route('payment') . '?id='.$item->id}}">
                                            Pay now
                                        </x-link>

                                    @elseif ($item->status === $item::FAILED)

                                        <strong class="text-yellow-500">Failed</strong>

                                    @elseif ($item->payment_status === $item::UNPAID && $item->status === $item::CANCELLED)

                                        <strong class="text-red-500">Canceled</strong>

                                    @else
                                        @if ($item->shipping_code)
                                            <strong>Shipping code</strong><br>
                                            <strong>{{ $item->shipping_code }}</strong>
                                        @else
                                            <strong class="text-green-500">Success</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
