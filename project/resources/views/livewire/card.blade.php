<div wire:click="flipCard({{ $id }})" >
    @if($isFlipped)
        <img src="{{ asset('images/' . $src) }}" alt="{{ $alt }}">
    @else
        <img src="https://picsum.photos/384/216" alt="Back of card">
    @endif
</div>