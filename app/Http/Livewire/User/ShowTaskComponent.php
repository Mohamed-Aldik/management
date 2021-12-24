<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Task;

class ShowTaskComponent extends Component
{
    public function activeTask($id)
    {

        $task=Task::find($id);
        $task->status='processing';
        $task->start_developer_date=now();
        $task->save();
        session()->flash("message", "Task has been status Active!");


    }  
    public function sendTask($id)
    {

        $task=Task::find($id);
        $task->status='finished';
        $task->end_developer_date=now();
        $task->save();
        session()->flash("message", "Task has been status Active!");


    } 
    public function inActiveTask($id)
    {

        $task=Task::find($id);
        $task->status='rejected';
        $task->save();
        session()->flash("message", "Task has been status Inactive!");


    }  
    public function render()
    {
        $tasks=Task::where('save',0)->where('user_id',auth()->user()->id)->get();
        return view('livewire.user.show-task-component', ['tasks' => $tasks]);
    }
}
