<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;

class Card extends Component
{
    public array $card;

    #[Session(key: 'id-{card.id}')]
    public string $id;
    public string $src;
    public string $alt;
    #[Session(key: 'isFlipped-{card.id}')]
    public bool $isFlipped = false;

    /**
     * Flip the card.
     *
     * @param string $id
     * @return void
     */
    public function flipCard(): void
    {
        $this->isFlipped = !$this->isFlipped;

        $this->dispatch('flip-card', id: $this->id, isFlipped: $this->isFlipped)->to(MemoryGame::class);

        // Then update the card details
        if ($this->isFlipped) {
            $card = \App\Models\Card::where('id', $this->id)->first();
            $this->src = asset('images/' . $card->src);
            $this->alt = $card->alt;
        } else {
            $this->src = 'https://picsum.photos/384/216';
            $this->alt = 'Back of card';
        }
    }

    /**
     * Mount the component.
     *
     * @param array $card
     * @return void
     */
    public function mount($card, $id): void
    {
        if ($this->isFlipped) {
            $card = \App\Models\Card::where('id', $id)->first();
            $this->id = $card->id;
            $this->src = asset('images/' . $card->src);
            $this->alt = $card->alt;
        } else {
            $this->id = $id;
            $this->src = 'https://picsum.photos/384/216';
            $this->alt = 'Back of card';
        }
    }

    #[On('reset-game')]
    public function resetGame(): void
    {
        $this->isFlipped = false;
        $this->mount(card: $this->card, id: $this->id);
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.card');
    }
}
