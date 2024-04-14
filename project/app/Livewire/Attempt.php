<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class Attempt extends Component
{
    public int $attempts = 0;
    #[On('increment-attempts')]
    public function updateAttempts(): void
    {
        $this->attempts++;
    }

    public function render(): View
    {
        return view('livewire.attempt');
    }
}
