<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Score extends Component
{
    public int $score = 0;

    #[On('increment-score')]
    public function incrementScore(): void
    {
        $this->score += 10;
    }

    #[On('decrement-score')]
    public function decrementScore(): void
    {
        if ($this->score > 0) {
            --$this->score;
        }
    }

    public function render(): View
    {
        return view('livewire.score');
    }
}
