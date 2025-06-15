@php
    $orderer = $getRecord()->orderer ?? null;
@endphp

@if ($orderer)
    <div class="space-y-1">
        <div class="font-semibold text-sm text-gray-800">{{ $orderer->name }}</div>
        <div class="text-sm text-gray-600">{{ $orderer->email }}</div>
        <div class="text-sm text-gray-600">{{ $orderer->phone_number ?? '-' }}</div>
    </div>
@else
    <div class="text-gray-500 italic text-sm">Data tidak tersedia</div>
@endif
