<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
class Attempt extends Component
{
    #[Session]
    public int $attempts = 0;

    #[On('increment-attempts')]
    public function updateAttempts(): void
    {
        $this->attempts++;
    }

    #[On('reset-game')]
    public function resetAttempts(): void
    {
        $this->attempts = 0;
    }

    public function render(): View
    {
        return view('livewire.attempt');
    }
}
