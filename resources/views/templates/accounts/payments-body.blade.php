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
        <div class="pull-left">
            <a class="btn btn-default" data-toggle="modal" data-target=".all-reports"><i class="fa fa-file-pdf-o"></i> Reports</a>
        </div>
        {!! Form::open(array('route' => 'search-payment', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search payments" name="search" class="form-control" type="text" required>
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
                        <th style="width:25%">Patient Name</th>
                        <th style="width:10%">Status</th>
                        <th style="width:20%">Type</th>
                        <th style="width:15%">Service</th>
                        <th style="width:10%">Cost</th>
                        <th class="text-center" style="width:20%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>
                            {{ $payment->patient->first_name }} {{ $payment->patient->middle_name }} {{ $payment->patient->last_name }}
                        </td>
                        <td>@if(($payment->status)===0)
                            <span class="text-danger">Not Paid</i></span>
                            @else
                            <span class="text-success">Paid</i></span>
                            @endif
                        </td>
                        <td>
                            @if($payment->insurance_id==0)
                            {{ str_limit("Self Sponsored", $limit = 15, $end = '...') }}
                            @else
                            Insurance
                            @endif
                        </td>
                        <td>
                            {{ str_limit($payment->service->service_name, $limit = 20, $end = '...') }}
                        </td>
                        <td>
                            {{ $settings->currency }} {{ $payment->service->cost }}
                        </td>
                        <td class="text-center">
                            @if(($payment->status)===0)
                            <div class="btn-group">
                                @if($payment->insurance_id==0)
                                <label aria-invalid="false" class="btn btn-xs btn-info" btn-checkbox="" data-toggle="modal" data-target=".confirm-cash-{{$payment->id}}"><i class="fa fa-money"></i> Confirm</label>
                                @else
                                <label style="" aria-invalid="false" class="btn btn-xs btn-primary" btn-checkbox="" data-toggle="modal" data-target=".confirm-insurance-{{$payment->id}}"><i class="fa fa-credit-card"></i> Confirm Payment</label>
                                @endif
                            </div>
                            @else
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target=".edit-{{$payment->id}}"><i class="fa fa-edit"></i> Edit</button>
                            @endif
                            <label aria-invalid="false" class="btn btn-xs btn-primary" btn-checkbox="" data-toggle="modal" data-target=".invoice-{{$payment->id}}"><i class="fa fa-file-text-o"></i> Invoice</label>
                            <!-- Invoice Payment -->
                            <div class="modal fade invoice-{{$payment->id}}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h3 class="blue bigger text-center">
                                                Invoice #: {{ Carbon\Carbon::parse($payment->created_at)->format('ymdHis') }}</h3>
                                            </div>
                                            <div class="modal-body">
                                                @include('templates.reports.accounts.patients-invoice')
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default btn-sm pull-left">Go Back</button>
                                                {!! Form::open(['method'=>'POST', 'action'=>['Medical\MedicalController@exportInvoice']])!!}
                                                <input type="hidden" name="payment_id" value="{{$payment->id}}"/>
                                                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-file-pdf-o"></i> Export Invoice</button>
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                            </td>
                        </tr>
                        <input type="hidden" class="form-control" name="on_patient" value="{{$payment->drug_id}}">
                        <!-- Confirm cash Payment -->
                        <div class="modal fade confirm-cash-{{$payment->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Confirm Cash Payment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-10 col-md-offset-1 text-center">
                                                    <p>Confirm cash payment of <i class="fa fa-money"></i> <strong> {{ $settings->currency }} {{ $payment->cost }}</strong> for <strong>{{ $payment->patient->first_name }} {{ $payment->patient->middle_name }} {{ $payment->patient->last_name }}</strong>?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-default btn-sm pull-left">Go Back</button>
                                            {!!Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@confirmPayment',$payment->id]])!!}
                                            {!! Form::submit('Confirm Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Insure Payment -->
                            <div class="modal fade confirm-insurance-{{$payment->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="blue bigger text-center">
                                                Confirm Insurance Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-10 col-md-offset-1 text-center">
                                                        <p>Confirm insurance payment for
                                                           <strong>{{ $payment->patient->first_name }} {{ $payment->patient->middle_name }} {{ $payment->patient->last_name }}</strong> of <strong>{{ $payment->cost }}</strong>.</p>
                                                           {!! Form::open(['method'=>'POST','url'=>'create-insurance','action'=>['Accounts\InsuranceController@createInsurance']])!!}
                                                           <div class="form-group">
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="insurance_provider" placeholder="Insurance Provider" required>
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="insurance_identifier" placeholder="Insurance Identifier" required>
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="hidden" class="form-control" name="payment_id" value="{{ $payment->id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-default btn-sm pull-left"><i class="fa fa-arrow-left"></i> Go Back</button>
                                                {!! Form::submit('Insure Payment', ['class' => 'btn btn-primary btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Confirm cash Payment -->
                                <!-- Edit Payment -->
                                <div class="modal fade edit-{{$payment->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger text-center">
                                                    Edit Payment</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {!! Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@updatePayment', $payment->id]])!!}
                                                        @if($payment->status===0)
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Edit Payment Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Paid" checked>
                                                                    <i></i>
                                                                    Paid
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Not Paid">
                                                                    <i></i>
                                                                    Not Paid
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Payment Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Paid">
                                                                    <i></i>
                                                                    Paid
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Not Paid" checked>
                                                                    <i></i>
                                                                    Not Paid
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(($payment->insurance_id)==1)
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Update Insurance Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="1" checked>
                                                                    <i></i>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="0">
                                                                    <i></i>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Update Insurance Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="1">
                                                                    <i></i>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="0" checked>
                                                                    <i></i>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="hidden" class="form-control" name="updatedBy" placeholder="UpdatedBy"
                                                            value="">
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
                                    <!-- Edit Payment -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer text-center bg-light lt">
                        <ul class="pagination">
                            {{ $payments->links() }}
                        </ul>
                    </div>
                </div>
                

                <!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Payment Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Payment Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportDailyPayments']])!!}
                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                @foreach($providers as $provider)
                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select><br>
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                            <br>
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Payment Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportMonthlyPayments']])!!}
                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                @foreach($providers as $provider)
                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select><br>
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <br>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                            <br>
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Report for All Payment Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportAllPayments']])!!}
                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                @foreach($providers as $provider)
                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select><br>
                                            <button class="btn btn-md btn-info col-md-4 pull-right">Export All Reports <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}<br><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>