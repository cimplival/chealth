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
@if (Session::has('info-dispensations'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info-dispensations') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-archives', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" placeholder="Search Archives" autocomplete="off" title="Search Archives" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-responsive">
            
            <thead>
                <tr>
                    <th style="width:15%">Med ID.</th>
                    <th style="width:20%">Patient Name</th>
                    <th style="width:25%">Name of Drug</th>
                    <th style="width:15%">Status</th>
                    <th style="width:10%">Paid</th>
                    <th style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dispensations->reverse() as $dispensation)
                @if(($dispensation->status)==2)
                <tr>
                    <td>
                        {{ $dispensation->medId }}
                    </td>
                    <td>
                        {{ $dispensation->onPatient }}
                    </td>
                    <td>
                        {{ str_limit($dispensation->prescription, $limit = 25, $end = '...') }}
                    </td>
                    <td>
                        @if(($dispensation->status)==0)
                        <span class="text-danger">Not Dispensed</span>
                        @elseif(($dispensation->status)==2)
                        Dispensed
                        @else
                        <span class="text-info">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if(($dispensation->paid)==0)
                            <span class="text-danger">Not Paid</span>
                        @else
                            Paid
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($dispensation->paid)==0)
                        <button class="btn btn-xs btn-info col-md-12" data-toggle="modal" data-target=".dispense-{{$dispensation->id}}"><i class="fa fa-check"></i> Dispense</button>
                        @elseif(($dispensation->status)==1) 
                        <button class="btn btn-xs btn-default col-md-12" data-toggle="modal" data-target=".prepare-{{$dispensation->id}}"><i class="fa fa-check"></i> Prepare</button>
                        @else
                        <button class="btn btn-xs btn-info col-md-12" data-toggle="modal" data-target=".view-{{$dispensation->id}}"><i class="fa fa-search"></i> View</button>
                        @endif
                    </td>
                </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade view-{{$dispensation->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                        Dispense Drug</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <label><strong>Medical ID:</strong> <i>{{ $dispensation->medId }}</i></label><br>
                                                    <label><strong>Patient Name:</strong> <i>{{ $dispensation->onPatient }}</i></label><br>
                                                    <label><strong>Doctor:</strong> <i>{{ $dispensation->from_user }}</i></label><hr>
                                                    <label><strong>Name of Drug:</strong> <i>{{ $dispensation->prescription }}</i></label><br>
                                                    <label><strong>Name of Drug:</strong> <i>{{ $dispensation->quantity_dispensed }}</i></label><br>
                                                    <label><strong>Description:</strong> <i>{{ $dispensation->description }}</i></label><br><hr>
                                                    <label><strong>Prescribed by:</strong> <i>{{ $dispensation->from_user }}</i></label><br>
                                                    <label><strong>Created on:</strong> <i>{{ Carbon\Carbon::parse($dispensation->created_at)->toDayDateTimeString() }}</i></label><br>
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
                                <!-- Edit Modal -->
                                @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <ul class="pagination">
                                    {{ $dispensations->links() }}
                                </ul>
                            </div>
                        </div>