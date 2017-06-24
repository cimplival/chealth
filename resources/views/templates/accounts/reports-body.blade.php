<div class="panel panel-default">
                                        <div class="panel-heading">
                                            Reports
                                            <!--<button class="btn btn-default btn-xs pull-right">
                                            <i class="fa fa-pencil"></i> New Appointment
                                            </button>-->
                                        </div>
                                        <div class="table-responsive">
                                            <table ui-jq="dataTable" ui-options="{ sAjaxSource: 'api/datatable.json',
                                                aoColumns: [
                                                { mData: 'engine' },
                                                { mData: 'browser' },
                                                { mData: 'platform' },
                                                { mData: 'version' },
                                                { mData: 'grade' }
                                                ]
                                                }" class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th style="width:20%">Patient</th>
                                                        <th style="width:15%">Doctor</th>
                                                        <th style="width:25%">Cost</th>
                                                        <th style="width:30%">Type</th>
                                                        <th style="width:10%">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>