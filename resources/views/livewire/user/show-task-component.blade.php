
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tasks</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              @if (Session::has('message'))
              <div class="alert alert-success" role="alert">
                  {{Session::get('message')}}
              </div>
              @endif
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>Start Date </th>
                      <th>End Date </th>
                      <th>Number of Days</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($tasks as $task)
                  <tr class= "@if($task->end_developer_date > $task->end_date) bg-warning @elseif($task->save == 1 ) bg-purple @elseif($task->status === 'rejected' ) bg-danger @elseif($task->status === 'processing') bg-primary @elseif($task->status === 'pending') bg-secondary @elseif($task->status === 'finished') bg-success  @endif ;">
                  <td><a href="{{route('view.task',['id'=>$task->id])}}" > <textarea readonly  style="width:250px; word-wrap:break-word;" rows="4">  {{$task->task}} </textarea> </a> </td>
                    <td>{{Carbon\Carbon::parse($task->start_date)->format('Y/m/d')}}</td>
                    <td>{{Carbon\Carbon::parse($task->end_date)->format('Y/m/d')}}</td>
                    <td>{{Carbon\Carbon::parse($task->start_date)->diffInDays($task->end_date)}}</td>
                    <td>@if($task->status === 'rejected' ) Rejected @elseif($task->status === 'processing') Processing @elseif($task->status === 'pending') Pending @elseif($task->status === 'finished') Finished @endif</td> 

                    <td>
                  
                    @if($task->status === 'pending')
                    <a href="#" onclick="confirm('Are you sure, You want to Access this Task ?') || event.stopImmediatePropagation()" wire:click.prevent="activeTask({{$task->id}})" style="margin-left:10px" >
                        <i class="fa fa-check fa-2x text-success"> </i>
                      </a>
                        
                      <a href="#" onclick="confirm('Are you sure, You want to Inaccess this user ?') || event.stopImmediatePropagation()" wire:click.prevent="inActiveTask({{$task->id}})" style="margin-left:10px" >
                    <i class="fa fa-times fa-2x text-danger"> </i>
                            </a>
                  @elseif($task->status === 'processing')
                  <a href="#" onclick="confirm('Are you sure, You want to send this user ?') || event.stopImmediatePropagation()" wire:click.prevent="sendTask({{$task->id}})" style="margin-left:10px" >
                    <i class="fa fa-paper-plane fa-2x text-success"> </i>
                            </a>

                  @elseif($task->status === 'rejected')
                  <i class="fa fa-window-close fa-2x text-danger"> </i>
                  @elseif($task->status === 'finished')
                  <i class="fa fa-check-square fa-2x text-success"> </i>

                  @endif
                    </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
        
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
