<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Card extends Component
{
    public string $id;
    public string $src;
    public string $alt;
    public bool $isFlipped = false;

    public array $card = [];

    public function flipCard($id): void
    {
        $this->isFlipped = !$this->isFlipped;

        $this->dispatch('flip-card', id: $id)->to(MemoryGame::class);
    }

    public function mount($card) : void
    {
        $this->id = $card['id'];
        $this->src = $card['src'];
        $this->alt = $card['alt'];
        $this->isFlipped = $card['isFlipped'];
    }

    public function render() : View
    {
        return view('livewire.card');
    }
}
