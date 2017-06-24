@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-service"><i class="fa fa-fw fa-plus"></i>Add Service</button>
        {!! Form::open(array('route' => 'search-services', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Services" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-xs table-hover table-responsive">

                <thead>
                    <tr>
                        <th style="width:20%">Service Name</th>
                        <th style="width:15%">Cost</th>
                        <th style="width:10%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($services->reverse() as $service)
                    <tr>
                        <td>
                            {{ $service->service_name }}
                        </td>
                        <td>
                            {{ $settings->currency }} {{ $service->cost }}
                        </td>
                        <td>
                            @if(($service->status)==0)
                            Disabled
                            @else
                            Enabled
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target=".edit-service-{{$service->id}}"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".{{$service->id}}"><i class="fa fa-trash"></i> Trash</button>
                        </td>
                    </tr>
                    <!-- Delete Service -->
                    <div class="modal fade {{$service->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="blue bigger">
                                        <i class="fa fa-trash"></i>
                                        Delete Service</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <p>Do you want to <b>permanently</b> delete this service?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!!Form::open()!!}
                                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                        {!!Form::close()!!}
                                        {!!Form::open(['method'=>'DELETE','action'=>['Accounts\ServicesController@deleteService',$service->id]])!!}
                                        {!! Form::submit('Delete Service', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Delete Service -->
                        <!-- Update Details Modal -->
                        <div class="modal fade edit-service-{{$service->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <h4 class="font-thin text-center"><i class="fa fa-pencil"></i> Edit Service<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(['method'=>'PUT','action'=>['Accounts\ServicesController@updateService', $service->id]])!!}
                                                <div class="form-group col-md-12">
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="service_name" placeholder="Name of Service" value="{{ $service->service_name }}">
                                                    </div>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="cost" placeholder="Cost of Service" value="{{ $service->cost }}">
                                                    </div>
                                                    @if($service->status==1)
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="1" checked>
                                                                <i></i>
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0">
                                                                <i></i>
                                                                Disable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="1">
                                                                <i></i>
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0" checked>
                                                                <i></i>
                                                                Disable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="hidden" name="from_user" value="{{ $user }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        {!! Form::submit('Update', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- End Update Details Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </tbody>
    </table>
</div>
<div class="panel-footer bg-light lt text-center">
    <ul class="pagination">
        {{ $services->links() }}
    </ul>
</div>
</div>
<!--  Add Service -->
<div class="modal fade add-service" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info dk">
                <h4 class="font-thin text-center">Add New Service <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['method'=>'POST', 'action'=>['Accounts\ServicesController@addService']])!!}
                        <div class="form-group col-md-12">
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="service_name" placeholder="Service Name" autocomplete="off" required>
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="cost" placeholder="Cost of Service" autocomplete="off" required>
                            </div>
                            <div class="input-group m-b col-md-12">
                                <select class="form-control" name="status" required>
                                    <option value="">Choose service status here...</option>
                                    <option value="1" selected>Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light lt">
                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                {!! Form::submit('Add Service', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                {!!Form::close()!!}
            </div>
        </div>
    </div><!-- /. modal dialog -->
</div><!-- /. modal-->
<!-- Add Service -->
