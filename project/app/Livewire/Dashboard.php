<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function newGame()
    {
        session()->flush();
        return redirect()->route('play');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
