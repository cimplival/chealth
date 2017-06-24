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
    <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-new-drug"><i class="fa fa-fw fa-plus"></i>New Drug</button>
        {!! Form::open(array('route' => 'search-inventory', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" autocomplete="off" title="Search Inventory" placeholder="Search Inventory" required>
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
                    <th style="width:25%">Description</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories->reverse() as $inventory)
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
                        {{ $inventory->quantity }}
                    </td>
                    <td>
                        {{ $inventory->description }}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".view-{{$inventory->id}}"><i class="fa fa-search"></i> View</button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".refill-drugs-{{$inventory->id}}"><i class="fa fa-fw fa-level-up"></i>Refill</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade view-{{$inventory->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                    View Inventory</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="col-md-10 col-md-offset-1">
                                            <label><strong>Name of Drug:</strong> <i>{{ $inventory->drug_name }}</i></label><br>
                                            <label><strong>Formulation:</strong> <i>{{  $inventory->formulation }}</i></label><br>
                                            <label><strong>Quantity:</strong> <i>{{ $inventory->quantity }}</i></label><br>
                                            <label><strong>Description:</strong> <i>{{ $inventory->description }}</i></label><br>
                                            <label><strong>Per Cost:</strong> {{ $settings->currency }} <i>{{ $inventory->per_cost }}</i></label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div><!-- /. modal dialog -->
                </div><!-- /. modal-->
                <!-- Consult Modal -->

                <!-- Add new drug Modal -->
                <div class="modal fade refill-drugs-{{$inventory->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                    Refill Inventory Drug</h4>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['method'=>'PUT','action'=>['Pharmacy\InventoryController@refillDrug', $inventory->id]])!!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="quantity_added" placeholder="Quantity" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                    {!! Form::submit('Refill Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <ul class="pagination">
                {{ $inventories->links() }}
            </ul>
        </div>
    </div>

    <!-- Add new drug Modal -->
    <div class="modal fade add-new-drug" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info dk text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">
                        Add New Drug</h4>
                    </div>
                    {!! Form::open(['method'=>'POST', 'action'=>['Pharmacy\InventoryController@refillNew']])!!}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="drug_name" placeholder="Name of Drug" autocomplete="off" required>
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
                                    <input type="text" class="form-control" name="quantity" placeholder="Quantity" autocomplete="off" required>
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