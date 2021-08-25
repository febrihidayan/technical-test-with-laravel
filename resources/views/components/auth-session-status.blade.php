@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm ' . (session('success') ? 'text-green-600' : 'text-red-600')]) }}>
        {{ $status }}
    </div>
@endif
