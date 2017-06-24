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
        {!! Form::open(array('route' => 'search-insurance-plans', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" autocomplete="off" placeholder="Search Insurance Plans" required>
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
                        <th style="width:15%">Provider</th>
                        <th style="width:14%">Med ID.</th>
                        <th style="width:20%">Patient</th>
                        <th style="width:15%">Identifier</th>
                        <th style="width:10%">Confirmed</th>
                        <th style="width:25%" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insurances->reverse() as $insurance)
                    <tr>
                        <td>
                            {{ str_limit($insurance->provider->name, $limit = 12, $end = '...') }}
                        </td>
                        <td>
                            {{ $insurance->patient->med_id }}
                        </td>
                        <td>

                            {{ str_limit($insurance->patient->first_name." ".$insurance->patient->middle_name." ".$insurance->patient->last_name , $limit = 22, $end = '...') }}
                        </td>
                        <td>
                            {{ $insurance->insurance_identifier }}
                        </td>
                        <td class="text-center">@if($insurance->confirmed==0)
                            No
                            @else
                            Yes
                            @endif
                        </td>
                        <td class="text-center">
                            @if($insurance->confirmed==0)
                            <a class="btn btn-xs btn-info" data-toggle="modal" data-target=".confirm-insurance-{{$insurance->id}}"><i class="fa fa-confirm"></i> Confirm</a>
                            @endif
                            <a class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit-insurance-{{$insurance->id}}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-insurance-{{$insurance->id}}">Trash <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- Confirm Insurance -->
                    <div class="modal fade confirm-insurance-{{$insurance->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                    Confirm Insurance Plan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            {!! Form::open(['method'=>'PUT','action'=>['Accounts\InsuranceController@confirmInsurancePlan', $insurance->id]])!!}
                                            <div class="form-group col-md-12 text-center">
                                                Confirm Insurance plan for this patient?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        {!! Form::submit('Confirm Insurance', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Confirm Insurance -->
                        <!-- Edit Insurance -->
                        <div class="modal fade edit-insurance-{{$insurance->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Edit Insurance Payment Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                {!! Form::open(['method'=>'PUT','action'=>['Accounts\InsuranceController@updateInsurance', $insurance->id]])!!}
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" name="insurance_provider" value="{{ $insurance->insurance_provider }}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" name="insurance_identifier" value="{{ $insurance->insurance_identifier }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                            {!! Form::submit('Update Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Edit Insurance -->
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