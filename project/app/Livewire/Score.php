<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Session;

class Score extends Component
{
    #[Session]
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

    #[On('reset-game')]
    public function resetScore(): void
    {
        $this->score = 0;
    }

    public function render(): View
    {
        return view('livewire.score');
    }
}
