<div>
    <h1>Final Fantasy Memory Quest</h1>
    <button wire:click="resetGame">Reset Game</button>
    <div class="memory-infos">
        @livewire(Score::class)
        @livewire(Attempt::class)
    </div>
    <div class="memory-board">
        @foreach($cards as $card)
            @livewire(Card::class, ['card' => $card, 'id' => $card['id'], 'isInError' => $card['isInError'] ?? false], key($card['id']))
        @endforeach
    </div>
</div>