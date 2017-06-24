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
        <div class="row padder-md">
            <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".create-backup"><i class="fa fa-database"></i> Create Backup</button>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-xs table-responsive">
                <thead>
                    <tr>
                        <th style="width:35%">Latest Backups</th>
                        <th style="width:20%">File Size</th>
                        <th class="text-center" style="width:20%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td><span class="text-ellipsis">{{$file->getFilename()}}</span></td>
                        <td><span class="text-ellipsis">{{$file->getSize()}} Bytes</span></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".restore-{{str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))}}"><i class="fa fa-history"></i> Restore</button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-{{str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))}}"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <!--  Restore Backup -->
                    <div class="modal fade restore-{{str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Restore a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@restoreBackup']])!!}
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12 text-center">
                                                    <label class="text-center">Do you want to restore this backup?</label>
                                                    <input type="hidden" class="form-control" name="backup_name" value="{{$file->getRealpath()}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    {!! Form::submit('Restore Database', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                    <!--  Delete Backup -->
                    <div class="modal fade delete-{{str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Delete a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@deleteBackup']])!!}
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12 text-center">
                                                    <label class="text-center">Do you want to delete this backup?</label>
                                                    <input type="hidden" class="form-control" name="backup_name" value="{{$file->getRealpath()}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    {!! Form::submit('Delete Database', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
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
        </ul>
    </div>
</div>
<!--  Create Backup -->
<div class="modal fade create-backup" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info dk">
                <h4 class="font-thin text-center">Create a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@createBackup']])!!}
                            <div class="input-group m-b col-md-12 text-center">
                                <label class="text-center">Do you want to make a backup manually?</label>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light lt">
                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                {!! Form::submit('Backup Database', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                {!!Form::close()!!}
            </div>
        </div>
    </div><!-- /. modal dialog -->
</div><!-- /. modal-->

