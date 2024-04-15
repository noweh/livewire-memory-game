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

    /**
     * Increment the score by 10.
     * Launches during the 'increment-score' event.
     *
     * @return void
     */
    #[On('increment-score')]
    public function incrementScore(): void
    {
        $this->score += 10;
    }

    /**
     * Decrement the score by 1.
     * Launches during the 'decrement-score' event.
     *
     * @return void
     */
    #[On('decrement-score')]
    public function decrementScore(): void
    {
        if ($this->score > 0) {
            --$this->score;
        }
    }

    /**
     * Reset the score to 0.
     * Launches during the 'reset-game' event.
     *
     * @return void
     */
    #[On('reset-game')]
    public function resetScore(): void
    {
        $this->score = 0;
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.score');
    }
}
