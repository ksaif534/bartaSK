<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\{Post,Comment};

class Comments extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.dashboard.comments');
    }
}
