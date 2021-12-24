<form wire:submit.prevent="addUser">

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <button  wire:click.prevent="openDiv" class="btn btn-success" >Add User</i></button>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              @if (Session::has('message'))
              <div class="alert alert-success" role="alert">
                  {{Session::get('message')}}
              </div>
              @endif
              @if ($showDiv)

              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><input type="text" class="form-control" placeholder="Enter Name" wire:model.lazy="name"></td>
                    <td><input type="email" class="form-control" placeholder="Enter Email" wire:model.lazy="email"></td>
                    <td><input type="password" class="form-control" placeholder="Enter Password" wire:model.lazy="password"></td>
                    <td>
                    <select class="form-control" wire:model.lazy="type" >
                        <option hidden selected >Choose</option>
                        <option value="Admin" >Admin</option>
                        <option value="Front-end" >Front-end</option>
                        <option value="Back-End" >Back-End</option>
                        <option value="Mobile-Developer" >Mobile-Developer</option>
                      </select>
                      </td>
             @if ($showAdd)
                      <td><button type="submit" class="btn btn-primary" >Submit</i></button></td>
                    @endif
                      
             @if ($showEdit)
             <td><button type="submit" class="btn btn-primary" >Update</i></button></td>
             
             @endif

                    </tr>
                    <tr>
                      <td>@error('name')<span class="text-danger">{{$message}}</span>@enderror</td>
                      <td>@error('email')<span class="text-danger">{{$message}}</span>@enderror</td>
                      <td>@error('password')<span class="text-danger">{{$message}}</span>@enderror</td>
                      <td>@error('type')<span class="text-danger">{{$message}}</span>@enderror</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <hr>
                @endif

                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Type User </th>
                      <th>Name </th>
                      <th>Email </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($usrs as $usr)

                    <tr>
                    <td>{{$usr->department}}</td>
                    <td>{{$usr->name}}</td>
                    <td>{{$usr->email}}</td>
                    <td>
                    
                    <a href="#"  wire:click.prevent="openDive({{$usr->id}})" style="margin-left:10px" >
                    <i class="fa fa-edit fa-2x text-primary"> </i>
                            </a>
                    @if($usr->utype !== 'ADM')
                    <a href="#" onclick="confirm('Are you sure, You want to delete this user ?') || event.stopImmediatePropagation()" wire:click.prevent="deleteUser({{$usr->id}})" style="margin-left:10px" >
                    <i class="fa fa-times fa-2x text-danger"> </i>
                            </a>
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

</form>
