<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Admin_account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $job, $profile;
    public $photo, $fullname, $phone, $email;
    public $current_password, $new_password, $new_password_confirmation;

    public function changePasswordSave()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|min:8|string'
        ]);
        $auth = Auth::guard('admin_account')->user();

        // The passwords matches
        if (!Hash::check($this->current_password, $auth->password))
        {
            $this->addError('psmatchs', 'Current Password is Invalid.');
        }

        // Current password and new password same
        if (strcmp($this->current_password, $this->new_password) == 0)
        {
            $this->addError('cpsamenp', 'New Password cannot be same as your current password.');
        }

        // Current password and new password confirmation
        if ($this->current_password != $this->new_password_confirmation)
        {
            $this->addError('confirm', 'The re-entered password does not match the new password.');
        }
        if ($this->current_password == $this->new_password_confirmation && Hash::check($this->current_password, $auth->password) && strcmp($this->current_password, $this->new_password) != 0){
            $user =  Admin_account::find($auth->id);
            $user->password =  Hash::make($this->new_password);
            $user->save();
            $this->addError('success', 'Password Changed Successfully.');
        }
    }

    public function profileChange()
    {
        $userid = Auth::guard('admin_account')->user()->id;
        if($this->photo != null){
            $this->validate([
                'photo' => 'image|max:1024', // 1MB Max
            ]);
            $this->photo->storeAs('images', $this->photo->getClientOriginalName(),['disk' => 'my']);
            $affected = Admin_account::where('id', $userid)
                ->update(['image' => $this->photo->getClientOriginalName()]);
        }
        if ($this->fullname != null){
            $this->validate([
                'fullname' => 'max:100',
            ]);

            $affected = Admin_account::where('id', $userid)
                ->update(['name' => $this->fullname]);
        }
        if ($this->phone != null){
            $this->validate([
                'phone' => 'unique:admin_account,phone',
            ]);

            $affected = Admin_account::where('id', $userid)
                ->update(['phone' => $this->phone]);
        }
        if ($this->email != null){
            $this->validate([
                'email' => 'email|unique:admin_account,email',
            ]);

            $affected = Admin_account::where('id', $userid)
                ->update(['email' => $this->email]);
        }
        $this->emit('loadsmallnavadmin');
    }

    public function delProImage(){
        $userid = Auth::guard('admin_account')->user()->id;
        $affected = Admin_account::where('id', $userid)
            ->update(['image' => null]);
        $this->emit('loadsmallnavadmin');
    }

    public function render()
    {
        $this->profile = Auth::guard('admin_account')->user();

        switch ($this->profile->role){
            case "1":
                $this->job = "Director";
                break;
            case "2":
                $this->job = "Total Manager";
                break;
            case "3":
                $this->job = "Import Manager";
                break;
            case "4":
                $this->job = "Order Manager canceled";
                break;
            case "5":
                $this->job = "Order Manager noprocess";
                break;
            case "6":
                $this->job = "Order Manager confirmed";
                break;
            case "7":
                $this->job = "Order Manager packing";
                break;
            case "8":
                $this->job = "Order Manager success";
                break;
            case "9":
                $this->job = "Delivery Manager";
                break;
            default:
                $this->job = "No profession specified";
        }

        return view('livewire.admin.profile');
    }
}
