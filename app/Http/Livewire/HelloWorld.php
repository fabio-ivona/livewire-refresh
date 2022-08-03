<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public string $name = '';

    public function render()
    {
        return view('livewire.hello-world');
    }
}
