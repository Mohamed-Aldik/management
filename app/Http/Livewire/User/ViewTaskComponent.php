<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Task;


class ViewTaskComponent extends Component
{
    public $idd;
    public function mount($id)
    {
        $id_exist = Task::where('id', $id)->first();
        if(!$id_exist){
            return abort(404);
        }
        $this->idd = $id;

    }   

    public function render()
    {
        $task=Task::find($this->idd);
        return view('livewire.user.view-task-component',['task'=>$task]);
    }
}
