<div class="modal fade summary-{{ $patient->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info dk text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">
                        Medical Summary</h4>
                    </div>
                    @include('templates.medical.summary-body')
                    <div class="modal-footer bg-light lt">
                        {!!Form::open()!!}
                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                        {!!Form::close()!!}
                        {!! Form::open(['method'=>'GET', 'action'=>['Medical\MedicalController@exportPDF']])!!}
                            <button type="submit" class="btn btn-sm btn-success pull-right"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export as PDF</button>
                        {!!Form::close()!!}
                    </div>
                </div>
                </div><!-- /. modal dialog -->
            </div>