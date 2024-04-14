<div>
    <h1>Final Fantasy Memory Quest</h1>
    <div class="memory-infos">
        @livewire(Score::class)
        @livewire(Attempt::class)
    </div>
    <div class="memory-board">
        @foreach($cards as $card)
            @livewire(Card::class, ['card' => $card], key($card['id']))
        @endforeach
    </div>
</div>