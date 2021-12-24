
      <style>

.cont {
  color: #333;
  margin: 0 auto;
  text-align: center;
}
.lii {
  display: inline-block;
  font-size: 1em;
  list-style-type: none;
  padding: 1em;
  text-transform: uppercase;
}

.sp {
  display: block;
  font-size: 1.5rem;
}

.emoji {
  display: none;
  padding: 1rem;
}

.emoji span {
  font-size: 4rem;
  padding: 0 .5rem;
}

@media all and (max-width: 768px) {
  .h {
    font-size: 1.5rem;
  }

  .lii {
    font-size: 1.125rem;
    padding: .75rem;
  }

  .sp {
    font-size: 3.375rem;
  }
}
</style>





<div class="container cont">
    <h3 class="h" id="headline">Countdown To Your Task:</h3>
    <div id="countdown">
      <ul>
        <li class="lii"><span class="sp" id="days"></span>days</li>
        <li class="lii"><span class="sp" id="hours"></span>Hours</li>
        <li class="lii"><span class="sp" id="minutes"></span>Minutes</li>
        <li class="lii"><span class="sp" id="seconds"></span>Seconds</li>
      </ul>
    </div>
    <div id="content" class="emoji">
    </div>
  </div>

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">@if($task->status === 'rejected' ) Rejected @elseif($task->status === 'processing') Processing @elseif($task->status === 'pending') Pending @elseif($task->status === 'finished') Finished @endif</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              @if (Session::has('message'))
              <div class="alert alert-success" role="alert">
                  {{Session::get('message')}}
              </div>
              @endif
                
            <div class="container">



            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>Start Date </th>
                      <th>End Date </th>
                      <th>Workdays</th>
                      <th>Actual Date</th>
                      <th>End Actual Date</th>
                      <th>Actual days</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr class= "@if($task->end_developer_date > $task->end_date) bg-warning @elseif($task->save == 1 ) bg-purple @elseif($task->status === 'rejected' ) bg-danger @elseif($task->status === 'processing') bg-primary @elseif($task->status === 'pending') bg-secondary @elseif($task->status === 'finished') bg-success  @endif ;">
                  <td> <textarea readonly  style="width:250px; word-wrap:break-word;" rows="4">  {{$task->task}} </textarea> </td>
                    <td>{{Carbon\Carbon::parse($task->start_date)->format('Y/m/d')}}</td>
                    <td>{{Carbon\Carbon::parse($task->end_date)->format('Y/m/d')}}</td>
                    <td>{{Carbon\Carbon::parse($task->start_date)->diffInDays($task->end_date)}}</td>
                    <td>@if($task->start_developer_date == null) @else {{ Carbon\Carbon::parse($task->start_developer_date)->format('Y/m/d') }} @endif</td>
                    <td>@if($task->end_developer_date == null) @else{{Carbon\Carbon::parse($task->end_developer_date)->format('Y/m/d')}}  @endif</td>
                    <td>{{Carbon\Carbon::parse($task->start_developer_date)->diffInDays($task->end_developer_date)}}</td>
                    <td>
                  @if($task->status === 'processing')
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
                  </tbody>
                </table>

            </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>



@push('scripts')

<script type="text/javascript">
    (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  let birthday = "{{($task == null) ?'' : Carbon\Carbon::parse($task->end_date)->format('Y/m/d h:m:s')}}",
      countDown = new Date(birthday).getTime(),
      x = setInterval(function() {
          
  let startDate = "{{($task == null) ?'' : Carbon\Carbon::parse($task->start_date)->format('Y/m/d h:m:s')}}";
        
  let now = new Date().getTime();
          let start= new Date(startDate).getTime() ;
         
          if (now > start)
          start = new Date().getTime();
          else{
          start = null;
          countDown = null ;
      }
          distance = countDown - start;

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          let headline = document.getElementById("headline"),
              countdown = document.getElementById("countdown"),
              content = document.getElementById("content");

          headline.innerText = "Time Is Over!";
          countdown.style.display = "none";
          content.style.display = "block";

          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
  </script>

@endpush
