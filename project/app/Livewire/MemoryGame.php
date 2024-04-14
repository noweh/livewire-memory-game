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
    public int $flippedCardsCount = 0;
    #[Session]
    public array $lastFlippedCard = [];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount(): void
    {
        if (!empty($this->cards)) {
            return;
        }

        $images = [
            ['src' => 'img_bahamut.webp', 'alt' => 'Bahamut'],
            ['src' => 'img_garuda.webp', 'alt' => 'Garuda'],
            ['src' => 'img_ifrit.webp', 'alt' => 'Ifrit'],
            ['src' => 'img_odin.webp', 'alt' => 'Odin'],
            ['src' => 'img_ramuh.webp', 'alt' => 'Ramuh'],
            ['src' => 'img_shiva.webp', 'alt' => 'Shiva'],
            ['src' => 'img_titan.webp', 'alt' => 'Titan']
        ];

        foreach ($images as $image) {
            $pair = [
                'lot' => uniqid(), // generate a unique id for each pair
                'src' => $image['src'],
                'alt' => $image['alt'],
                'isFlipped' => false
            ];
            $this->cards[] = $pair;
            $this->cards[] = $pair;
        }

        // add an ID to each card
        $this->cards = array_map(function ($card) {
            $card['id'] = crc32(uniqid());
            return $card;
        }, $this->cards);

        shuffle($this->cards); // shuffle the cards
    }

    /**
     * Flip a card.
     * Launches during the 'flip-card' event.
     *
     * @param string $id
     * @return void
     */
    #[On('flip-card')]
    public function flipCard($id): void
    {
        // Find the current card
        $key = array_search($id, array_column($this->cards, 'id'));
        $currentCard = $this->cards[$key];

        // Flip the current card
        $this->cards[$key]['isFlipped'] = !$currentCard['isFlipped'];

        // Check if the current card is flipped
        if (!$currentCard['isFlipped']) {
            // Check if there are two flipped cards
            if ($this->flippedCardsCount % 2 === 0) {
                // Store the current card as the last flipped card
                $this->lastFlippedCard = $currentCard;
            } else {
                // Dispatch the appropriate event based on whether the current card matches the last flipped card
                if ($currentCard['lot'] === $this->lastFlippedCard['lot']) {
                    $this->dispatch('increment-score');
                } else {
                    $this->dispatch('increment-attempts');
                    $this->dispatch('decrement-score');
                }
            }
        }

        // Update the count of flipped cards
        $this->flippedCardsCount = $currentCard['isFlipped'] ? ++$this->flippedCardsCount : --$this->flippedCardsCount;
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
        $this->lastFlippedCard = [];
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
