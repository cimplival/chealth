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
        <button class="btn btn-sm btn-default btn-rounded pull-left" data-toggle="modal" data-target=".add-new-drug"><i class="fa fa-fw fa-plus"></i>New</button>
        <!-- Add new drug Modal -->
        <div class="modal fade add-new-drug" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info dk text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">
                            Add New Drug</h4>
                        </div>
                        {!! Form::open(['method'=>'POST', 'action'=>['Pharmacy\RefillController@refillNew']])!!}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" name="drug_name" placeholder="Name of Drug" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <select class="form-control" name="formulation" required>
                                            <option value="">Choose Formulation</option>
                                            <option value="Pills">Pills</option>
                                            <option value="Tablets">Tablets</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" name="quantity" placeholder="Quantity" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light lt">
                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                            {!! Form::submit('Add New Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div><!-- /. modal dialog -->
            </div><!-- /. modal-->
            <!-- Add new drug Modal -->
            {!! Form::open(array('route' => 'search-refills', 'class'=>'form-inline text-right')) !!}
            <div class="form-group">
                <div class="input-group">
                    <input placeholder="Search Refills" name="search" class="form-control" type="text" title="Search Refills" autocomplete="off" required>
                    <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-sm table-responsive">
                
                <thead>
                    <tr>
                        <th style="width:10%">Drug ID.</th>
                        <th style="width:20%">Name of Drug</th>
                        <th style="width:15%">Formulation</th>
                        <th style="width:10%">Quantity</th>
                        <th style="width:20%">Description</th>
                        <th style="width:20%">Refilled By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($refills->reverse() as $refill)
                    <tr>
                        <td>
                            {{ $refill->drug_id }}
                        </td>
                        <td>
                            {{ $refill->drug_name }}
                        </td>
                        <td>
                            {{ $refill->formulation }}
                        </td>
                        <td>
                            {{ $refill->quantity }}
                        </td>
                        <td>
                            {{ str_limit($refill->description, $limit = 20, $end = '...') }}
                        </td>
                        <td>
                            {{ $refill->users->full_name }}
                        </td>
                    </tr>
                    <div class="modal fade refill-{{$refill->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="blue bigger">
                                        <i class="fa fa-trash"></i>
                                        Please, Confirm to cancel this refill?</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <p>Are you sure you want to <b>Permanently</b> cancel this refill?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!!Form::open()!!}
                                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                        {!!Form::close()!!}
                                        {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$refill->id]])!!}
                                        {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <ul class="pagination">
                    {{ $refills->links() }}
                </ul>
            </div>
        </div>