<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Navbar extends Component
{

    public $notifications;

    public function markAsRead(string $notificationId)
    {
        DB::table('notifications')->where('id',$notificationId)->update([
            'read_at'   => Carbon::now()
        ]);

        return back()->with(['msg' => 'Notification Read Successfully']);
    }
    
    public function render()
    {
        return view('livewire.dashboard.navbar');
    }
}
