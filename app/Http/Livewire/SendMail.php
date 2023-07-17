<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;

class SendMail extends Component
{
    protected $listeners = ['mail'];

    public function mail($datas){



















        Mail::to($datas[0])->send(new MailNotify($datas[1]));
    }

    public function render()
    {
        return view('livewire.send-mail');
    }
}
