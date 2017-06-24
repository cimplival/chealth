@if (count($errors) > 0)
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Whoops! Sorry!</strong> There were some problems with your input.<br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif

<div class="panel panel-default">
                    <div class="panel-heading">
                        <button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target=".new-user"><li class="fa fa-plus"></li> Add a New User</button>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-xs table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width:20%">Full Name</th>
                                        <th style="width:15%">User Name</th>
                                        <th style="width:15%">Staff ID</th>
                                        <th style="width:30%">Role</th>
                                        <th class="text-center" style="width:20%">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->reverse() as $user)
                                    <tr>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->staff_id}}</td>
                                        <td class="text-capitalize">
                                            @foreach($user->roles as $role)
                                                <span class="label label-info">{{$role->name}}</span>
                                            @endforeach  
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".view-{{$user->id}}" title="View User"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit-{{$user->id}}" title="Edit User"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".add-role-{{$user->id}}" title="Add Role"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".remove-role-{{$user->id}}" title="Remove Role"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-{{$user->id}}" title="Delete User"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <!--  View User Modal -->
                                    <div class="modal fade view-{{$user->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info dk">
                                                    <h4 class="font-thin text-center">View User<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <label><strong>Full Name: </strong> {{ $user->full_name }}</label><br>
                                                                <label><strong>User Name:</strong> {{ $user->user_name }}</label><br>
                                                                <label><strong>Staff ID:</strong> {{ $user->staff_id }}</label><br>
                                                                <label class="text-capitalize"><strong>Current Role:</strong>
                                                                    @foreach($user->roles as $role)
                                                                        <span class="label label-info">{{$role->name}}</span>
                                                                    @endforeach
                                                                </label><br>
                                                                <label><strong>Created on:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('l\\, jS F Y') }}</label><br>
                                                                <label><strong>Updated on:</strong> {{ \Carbon\Carbon::parse($user->updated_at)->format('l\\, jS F Y') }}</label><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light lt">
                                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                </div>
                                            </div>
                                        </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                    <!--  Add Role to User Modal -->
                                    <div class="modal fade add-role-{{$user->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info dk">
                                                    <h4 class="font-thin text-center">Add User Role<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Admin\UsersController@addRole']])!!}
                                                        <div class="col-xs-12 col-sm-12">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <label class="text-capitalize"><strong>Current User Role:</strong>
                                                                    @foreach($user->roles as $role)
                                                                        <span class="label label-info">{{$role->name}}</span>
                                                                    @endforeach
                                                                </label><br><br>
                                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                <div class="input-group col-md-12">
                                                                     <select class="form-control text-capitalize m-b" name="role_name">
                                                                        <option value="">Add User Role...</option>
                                                                        @foreach($roles as $role)
                                                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light lt">
                                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                    {!! Form::submit('Add Role to User', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                    {!!Form::close()!!}
                                                </div>
                                            </div>
                                        </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                    <!--  Remove Role to User Modal -->
                                    <div class="modal fade remove-role-{{$user->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info dk">
                                                    <h4 class="font-thin text-center">Remove User Role<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Admin\UsersController@removeRole']])!!}
                                                        <div class="col-xs-12 col-sm-12">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <label class="text-capitalize"><strong>Current User Role:</strong>
                                                                    @foreach($user->roles as $role)
                                                                        <span class="label label-info">{{$role->name}}</span>
                                                                    @endforeach
                                                                </label><br><br>
                                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                <div class="input-group col-md-12">
                                                                     <select class="form-control text-capitalize m-b" name="role_name" required="">
                                                                        <option value="">Remove User Role...</option>
                                                                        @foreach($user->roles as $role)
                                                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light lt">
                                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                    {!! Form::submit('Add Role to User', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                    {!!Form::close()!!}
                                                </div>
                                            </div>
                                        </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                    <!-- Delete User -->
                                    <div class="modal fade delete-{{$user->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info dk">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="blue bigger text-center">
                                                        Delete User</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row text-center">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <p>Are you sure you want to <b>permanently</b> delete this user?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light bg">
                                                        {!!Form::open()!!}
                                                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                                        {!!Form::close()!!}
                                                        {!!Form::open(['method'=>'DELETE','action'=>['Admin\UsersController@deleteUser',$user->id]])!!}
                                                        {!! Form::submit('Delete User', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                                        {!!Form::close()!!}
                                                    </div>
                                                </div>
                                            </div><!-- /. modal dialog -->
                                        </div>
                                        <!-- Edit User Modal -->
                                        <div class="modal fade edit-{{$user->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info dk">
                                                        <h4 class="font-thin text-center">Edit User <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                {!! Form::open(['method'=>'PUT','action'=>['Admin\UsersController@editUser', $user->id]])!!}
                                                                <div class="form-group col-md-12">
                                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                    <div class="input-group m-b col-md-12">
                                                                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" autocomplete="off" value="{{ $user->full_name }}" required>
                                                                    </div>
                                                                    <div class="input-group m-b col-md-12">
                                                                        <input type="text" class="form-control" name="username" placeholder="User Name" autocomplete="off"  value="{{ $user->user_name }}" title="The username will be used for signing into cHealth." required>
                                                                    </div>
                                                                    <div class="input-group m-b col-md-12">
                                                                        <input type="text" class="form-control" name="staffId" autocomplete="off" value="{{ $user->staff_id }}" required>
                                                                    </div>
                                                                    <div class="input-group m-b col-md-12">
                                                                        <input type="password" class="form-control" name="password" placeholder="Enter New Password" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light lt">
                                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                        {!! Form::submit('Update Changes', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                        {!!Form::close()!!}
                                                    </div>
                                                </div>
                                            </div><!-- /. modal dialog -->
                                        </div><!-- /. modal-->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer text-center bg-light lt">
                            <ul class="pagination">
                                {{$users->links()}}
                            </ul>
                        </div>
                    </div>

                    <!-- Add new User Modal -->
                    <div class="modal fade new-user" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Add a New User <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::open(['method'=>'POST', 'action'=>['Admin\UsersController@createNewUser']])!!}
                                            <div class="form-group col-md-12">
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name" autocomplete="off" value="{{Request::old('fullname')}}" required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="username" placeholder="User Name" autocomplete="off"  value="{{Request::old('username')}}" title="The username will be used for signing into cHealth." required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="staff_id" placeholder="Staff ID" autocomplete="off" value="{{Request::old('staff_id')}}" required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="password" class="form-control" name="password" placeholder="Password"  required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <select name="role_name" class="form-control text-capitalize m-b" value="{{Request::old('role_name')}}" required>
                                                        <option value="">Select User Role...</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    {!! Form::submit('Add New User', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->

        
