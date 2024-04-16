<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;

class MemoryGame extends Component
{
    #[Session]
    public array $cards = [];
    #[Session]
    public string $lastFlippedCardLot = "";

    protected $listeners = ['refresh-component' => '$refresh'];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount(): void
    {
        if (empty($this->cards)) {
            $this->cards = \App\Models\Card::select(['id'])->get()->toArray();
            shuffle($this->cards); // shuffle the cards
        }
    }

    /**
     * Flip a card.
     * Launches during the 'flip-card' event.
     *
     * @param string $id
     * @param bool $isFlipped
     * @return void
     */
    #[On('flip-card')]
    public function flipCard(string $id, bool $isFlipped): void
    {
        // Find the current card
        $key = array_search($id, array_column($this->cards, 'id'));

        // Flip the current card
        $this->cards[$key]['isFlipped'] = $isFlipped;

        // Check if the current card is flipped
        if ($this->cards[$key]['isFlipped'] === true) {
            $flippedCards = array_filter($this->cards, function($card) {
                if (isset($card['isFlipped'])) {
                    return $card['isFlipped'] === true;
                }
                return false;
            });

            // Check if there are two flipped cards
            if (count($flippedCards) % 2 === 0) {
                // Dispatch the appropriate event based on whether the current card matches the last flipped card
                if (\App\Models\Card::select('lot')->where('id', $id)->pluck('lot')->first() === $this->lastFlippedCardLot) {
                    $this->dispatch('increment-score');
                } else {
                    $this->dispatch('increment-attempts');
                    $this->dispatch('decrement-score');
                }
            } else {
                // Store the current card as the last flipped card
                $this->lastFlippedCardLot = \App\Models\Card::select('lot')->where('id', $id)->pluck('lot')->first();
            }
        }

        $this->dispatch('refresh-component');
    }

    /**
     * Reset the game.
     * Launches during the 'reset-game' event.
     *
     * @return void
     */
    public function resetGame(): void
    {
        $this->cards = [];
        $this->flippedCardsCount = 0;
        $this->lastFlippedCardLot = "";
        $this->dispatch('reset-game');
        $this->mount();
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.memory-game');
    }
}
