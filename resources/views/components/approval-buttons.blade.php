<div class="flex gap-2">
    @if ($record->status === 'pending')
        @if (auth()->user()->role === 'approver_cabang' && $record->current_approval === 0)
            <form method="POST" action="{{ route('booking.approve', $record->id) }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Setujui</button>
            </form>
        @elseif (auth()->user()->role === 'approver_pusat' && $record->current_approval === 1)
            <form method="POST" action="{{ route('booking.approve', $record->id) }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Setujui</button>
            </form>
        @endif

        <form method="POST" action="{{ route('booking.reject', $record->id) }}">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tolak</button>
        </form>
    @else
        <span class="text-sm text-gray-500 italic">{{ ucfirst($record->status) }}</span>
    @endif
</div>
