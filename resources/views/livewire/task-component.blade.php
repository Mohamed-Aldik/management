<form wire:submit.prevent="addTask">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a wire:click.prevent="openDiv()" href="#" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus fa-2x text-success"> </i>
                        </a>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" wire:model.lazy="save" type="checkbox"
                                                id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Save</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Task</label>
                                            <textarea maxlength="110" wire:model.lazy="task" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3"></textarea>
                                            @error('task')<span
                                                class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Developer</label>
                                            <select id="exampleFormControlSelect2" class="form-control"
                                                wire:model.lazy="usr">
                                                <option hidden selected>Choose</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('usr')<span
                                                class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Start Date</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                                wire:model.lazy="start_date">
                                            @error('start_date')<span
                                                class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">End Date</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                                wire:model.lazy="end_date">
                                            @error('end_date')<span
                                                class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.lazy="important"
                                                id="inlineRadio1" checked value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.lazy="important"
                                                id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.lazy="important"
                                                id="inlineRadio2" value="3">
                                            <label class="form-check-label" for="inlineRadio2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.lazy="important"
                                                id="inlineRadio2" value="4">
                                            <label class="form-check-label" for="inlineRadio2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.lazy="important"
                                                id="inlineRadio3" value="5">
                                            <label class="form-check-label" for="inlineRadio3">5 (Important)</label>
                                        </div>
                                        <br>
                                        @error('important')<span
                                            class="text-danger">{{ $message }}</span>@enderror

                                    </div>
                                    <div class="modal-footer">
                                        @if ($showAdd)
                                            <td><button type="submit" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">Submit</i></button></td>
                                        @endif

                                        @if ($showEdit)
                                            <td><button data-toggle="modal" data-target="#exampleModal" type="submit"
                                                    class="btn btn-primary">Update</i></button></td>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Task</th>
                                    <th>Developer</th>
                                    <th>Approx time</th>
                                    <th>Important</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach ($tasks as $task)

                                    <tr class="@if ($task->end_developer_date > $task->end_date) bg-warning @elseif($task->save == 1 ) bg-purple @elseif($task->status === 'rejected' ) bg-danger @elseif($task->status === 'processing') bg-primary @elseif($task->status === 'pending') bg-secondary @elseif($task->status === 'finished') bg-success  @endif ;">
                                        <td> {{ $count }} <input type="checkbox" value="{{ $task->id }}"
                                                wire:model.lazy="selectedtypes"></td>

                                        <td> <a href="{{ route('view.task', ['id' => $task->id]) }}"> <textarea readonly
                                                    style="width:250px; word-wrap:break-word;"
                                                    rows="4"> {{ $task->task }} </textarea> </a> </td>
                                        <td>{{ $task->user->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($task->start_date)->diffInDays($task->end_date) }}
                                        </td>
                                        <td> {{ $task->important }}</td>
                                        <td>

                                            <a style="margin-left:10px"
                                                wire:click.prevent="openDive({{ $task->id }})" href="#"
                                                data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-edit fa-2x text-light"> </i></a>

                                            <a href="#"
                                                onclick="confirm('Are you sure, You want to delete this task ?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="deleteTask({{ $task->id }})"
                                                style="margin-left:10px">
                                                <i class="fa fa-times fa-2x text-light"> </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
</form>
