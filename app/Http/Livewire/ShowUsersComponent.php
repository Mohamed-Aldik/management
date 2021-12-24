<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class ShowUsersComponent extends Component
{
    public $showDiv = false;
    public $showAdd = false;
    public $showEdit = false;
    public $name;
    public $email;
    public $password;
    public $type;
    public $idd = null;

    public function openDiv()
    {
        $this->showDiv = true;
        $this->showAdd = true;
        $this->showEdit = false;
        $this->idd = null;
        $this->name = null;
        $this->type= null;
        $this->email= null;
        $this->password= null;

    }
    public function openDive($id)
    {
        $this->showDiv = true;
        $this->showEdit = true;
        $this->showAdd = false;
        $this->idd = $id;
        $user= User::find($this->idd);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type= $user->department;
    }

    use WithPagination;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
         
            'name' => 'required',
            'password' => 'required | min:8',
            'type' => 'required',
            'email' => 'required | email | unique:users,email,'.$this->idd.',id',
        ]);
    }

    public function addUser() {
        $this->validate([
            'name' => 'required',
            'password' => 'required | min:8',
            'type' => 'required',
            'email' => 'required | email | unique:users,email,'.$this->idd.',id',

        ]);
        if($this->idd == null)
            $user=new User();
        else
        $user= User::find($this->idd);
               $user->name = $this->name;
               $user->password=Hash::make( $this->password);
               $user->email= $this->email;
               $user->department= $this->type;
               $user->save();
               session()->flash("message", "User has been successfully!");
               $this->showDiv = false;
               $this->reset();

       }

    public function deleteUser($id)
    {
        $usr = User::find($id);
        $usr->delete();
        session()->flash('message', 'User has been delete successfully!');
    }

    public function render()
    {
        $usrs = User::paginate(10);

        return view('livewire.show-users-component', ['usrs' => $usrs]);
    }
}
