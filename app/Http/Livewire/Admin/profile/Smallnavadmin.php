<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Admin_account;
use App\Models\Invoice;
use Carbon\Carbon;

class Smallnavadmin extends Component
{
//    check role and return notification
    protected $listeners = ['loadsmallnavadmin'];
    public $job, $profile, $tb, $time;
    public function loadsmallnavadmin(){}

    public function getTb(){
        $currentTime = Carbon::now();
        $this->tb = Invoice::where('see',0)->count();

        if ($this->tb != 0){
            $createdAt = Invoice::where('see',0)->orderBy('id', 'ASC')->first()->created_at;
            $timeDifference = $currentTime->diffInMinutes($createdAt);

            $thirtyMinutesAgo = $currentTime->subMinutes($timeDifference);

            $this->time =  $thirtyMinutesAgo->diffForHumans();
        }
    }

    public function render()
    {
        $this->profile = Auth::guard('admin_account')->user();

        switch ($this->profile->role){
            case "1":
                $this->job = "Director";
                break;
            case "2":
                $this->job = "Staff";
                break;
            case null:
                $this->job = "Default account";
                break;
            default:
                $this->job = "No profession specified";
        }
        return view('livewire.admin.smallnavadmin');
    }
}
