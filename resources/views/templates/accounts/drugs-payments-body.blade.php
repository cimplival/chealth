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
        {!! Form::open(array('route' => 'search-drugs-accounts', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Drugs" name="search" class="form-control" type="text" autocomplete="off" required>
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
                        <th style="width:18%">Drug ID.</th>
                        <th style="width:20%">Name of Drug</th>
                        <th style="width:13%">Formulation</th>
                        <th style="width:20%">Description</th>
                        <th style="width:15%">Drug Cost</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                    <tr>
                        <td>
                            {{ $inventory->drug_id }}
                        </td>
                        <td>
                            {{ $inventory->drug_name }}
                        </td>
                        <td>
                            {{ $inventory->formulation }}
                        </td>
                        <td>
                            {{ str_limit($inventory->description, $limit = 30, $end = '...') }}
                        </td>
                        <td>
                            {{ $settings->currency }} {{ $inventory->per_cost }}
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".add-price-{{$inventory->id}}"><i class="fa fa-edit"></i> Edit Cost</button>
                        </td>
                    </tr>
                    <!-- Add new drug Modal -->
                    <div class="modal fade add-price-{{$inventory->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        Add Price</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['method'=>'PUT','action'=>['Accounts\DrugsPaymentsController@updateCost', $inventory->id]])!!}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="form-group col-md-10 col-md-offset-1">
                                                    <input type="hidden" name="drug_id" value="{{ $inventory->id }}">  
                                                    <span class="font-bold">Name of Drug:</span> {{ $inventory->drug_name }}<br>
                                                    <span class="font-bold">Formulation:</span> {{ $inventory->formulation }}<br>
                                                    <span class="font-bold">Description:</span> {{ $inventory->description }}
                                                </div>
                                                <div class="form-group col-md-6 col-md-offset-1">
                                                    <input type="text" class="form-control" name="per_cost" placeholder="Cost per formulation" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        {!! Form::submit('Refill Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
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
        <div class="panel-footer bg-light lt text-center">
            <ul class="pagination">
               {{ $inventories->links() }}
           </ul>
       </div>
   </div>
