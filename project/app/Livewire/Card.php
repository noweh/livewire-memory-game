<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class Card extends Component
{
    public string $id;
    public string $src;
    public string $alt;
    public bool $isFlipped = false;

    public array $card = [];

    /**
     * Flip the card.
     *
     * @param string $id
     * @return void
     */
    public function flipCard($id): void
    {
        $this->isFlipped = !$this->isFlipped;

        $this->dispatch('flip-card', id: $id)->to(MemoryGame::class);
    }

    /**
     * Mount the component.
     *
     * @param array $card
     * @return void
     */
    public function mount($card): void
    {
        $this->id = $card['id'];
        $this->src = $card['src'];
        $this->alt = $card['alt'];
        $this->isFlipped = $card['isFlipped'];
    }

    #[On('reset-game')]
    public function resetGame(): void
    {
        $this->isFlipped = false;
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
