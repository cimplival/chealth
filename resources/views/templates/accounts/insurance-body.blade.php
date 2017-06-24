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
        {!! Form::open(array('route' => 'search-insurances', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Insurances" name="search" class="form-control" type="text" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-responsive">
                <thead>
                    <tr>
                        <th style="width:15%">Insurance ID.</th>
                        <th style="width:20%">Provider</th>
                        <th style="width:20%">Patient</th>
                        <th style="width:15%">Service</th>
                        <th style="width:13%">Cost</th>
                        <th style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insurances->reverse() as $insurance)
                    <tr>
                        <td>
                            {{ $insurance->insurance_plan->insurance_identifier }}
                        </td>
                        <td>
                            {{ $insurance->insurance_plan->provider->name }}
                        </td>
                        <td>
                            {{ $insurance->patient->first_name }} {{ $insurance->patient->middle_name }} {{ $insurance->patient->last_name }}
                        </td>
                        <td>
                            {{ $insurance->service->service_name }}
                        </td>
                        <td>
                            {{ $settings->currency }} {{ $insurance->cost }}
                        </td>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-insurance-{{$insurance->id}}"><i class="fa fa-eye"></i> View</a>
                                <a class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-insurance-{{$insurance->id}}"><i class="fa fa-trash"></i> Trash</a>
                            </div>
                        </td>
                    </tr>
                    <!-- View Insurance -->
                    <div class="modal fade view-insurance-{{$insurance->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        View Insurance Record</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-b">
                                            <div class="col-md-5 col-md-offset-1 text-right font-bold">
                                                Insurance ID: <br>
                                                Insurance Provider: <br>
                                                Patient: <br>
                                                Service: <br>
                                                Cost: <br>
                                                Created on: 
                                            </div>
                                            <div class="col-md-5">
                                                {{ $insurance->insurance_plan->insurance_identifier }} <br>
                                                {{ $insurance->insurance_plan->provider->name }}<br>
                                                {{ $insurance->patient->first_name }} {{ $insurance->patient->middle_name }} {{ $insurance->patient->last_name }} <br>
                                                {{ $insurance->service->service_name }}<br>
                                                {{ $settings->currency }} {{ $insurance->cost }}<br>
                                                {{ Carbon\Carbon::parse($insurance->created_at)->toDayDateTimeString() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light bg">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div>
                        <!-- Delete Insurance -->
                        <div class="modal fade delete-insurance-{{$insurance->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Delete Insurance?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 text-center">
                                                    <p>Are you sure you want to <b>Permanently</b> delete this insurance payment?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                            {!!Form::open(['method'=>'DELETE','action'=>['Accounts\InsuranceController@deleteInsurance',$insurance->id]])!!}
                                            {!! Form::submit('Yes, Delete', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Delete Insurance -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer bg-light lt text-center">
                <ul class="pagination">
                    {{ $insurances->links() }}
                </ul>
            </div>
        </div>