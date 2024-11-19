<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Comments extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.dashboard.comments');
    }
}
