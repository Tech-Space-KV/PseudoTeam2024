<?php

namespace App\Livewire;

use App\Models\Hardware;
use Livewire\Component;

class Hardwares extends Component
{
    public function render()
    {
        $hardwares = Hardware::all();

        return view('livewire.hardwares' , compact('hardwares'));
    }
}
