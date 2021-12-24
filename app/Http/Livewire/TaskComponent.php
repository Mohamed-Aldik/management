<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskComponent extends Component
{
    public $selectedtypes = [];
    public $task;
    public $usr;
    public $important;
    public $save = 0;
    public $start_date;
    public $end_date;
    public $showAdd = false;
    public $showEdit = false;
    public $idd = null;

    
    public function openDiv()
    {
        $this->showEdit = false;
        $this->showAdd = true;
        $this->usr = null;
        $this->save = null;
        $this->important =  null;


    }
    public function openDive($id)
    {
        $this->showEdit = true;
        $this->showAdd = false;
        $this->idd = $id;
        $task= Task::find($id);
        $this->task  = $task->task ;
        $this->usr =  $task->user_id;
        $this->start_date =  $task->start_date;
        $this->important =  $task->important;
        $this->save =  $task->save;
        $this->end_date = $task->end_date;

    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        session()->flash('message', 'Task has been delete successfully!');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
         
            'task' => 'required',
            'usr' => 'required',
            'important' => 'required',
            'start_date' => 'required',
            'end_date' => 'required | after_or_equal:start_date | after_or_equal:today',
        ]);
    }

    public function addTask() {
        $this->validate([
            'task' => 'required',
            'usr' => 'required',
            'important' => 'required',
            'start_date' => 'required',
            'end_date' => 'required | after_or_equal:start_date | after_or_equal:today',

        ]);
        if($this->idd == null)
        $task=new Task();
          else
               $task= Task::find($this->idd);
               $task->task = $this->task;
               $task->status = 'pending';
               $task->important = $this->important;
               $task->start_date= $this->start_date;
               $task->end_date= $this->end_date;
               $task->user_id= $this->usr;
               
               $task->save=  $this->save;


               $task->save();
               session()->flash("message", "Task has been Added successfully!");
               
               $this->reset();


       }

    public function render()
    {
   
        $tasks=Task::all();
        $users=User::where('utype','USR')->get();

   
        return view('livewire.task-component', ['tasks' => $tasks,'users'=>$users]);
    }
}
