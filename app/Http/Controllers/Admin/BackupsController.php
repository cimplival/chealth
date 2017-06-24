<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backup;
use File;
use Artisan;

class BackupsController extends Controller
{

    public function getBackups(Request $request)
    {

    	$page = (int) $request->input('page') ?: 1;

      $files = collect(File::allFiles("../storage/app/http---localhost"));
      $onPage = 50;


      $slice = $files->slice(($page-1)* $onPage, $onPage);

      $paginator = new \Illuminate\Pagination\LengthAwarePaginator($slice, $files->count(), $onPage);

    	//$files = File::allFiles('../storage/backup');

      return view('templates.admin.backups', compact('files'))->with('files', $paginator);

  }

  public function createBackup(Request $request)
  {
     $this->validate($request, [
        'backup_name'      => 'min:4|max:100',
        ]);

     Artisan::call('backup:run');
     return redirect()->route('admin-backups')->with('success', 'A new backup has been created successfully.');
 }

 public function restoreBackup(Request $request)
 {
   $this->validate($request, [
    'backup_name'      => 'min:4',
    ]);

   $backup_name = $request->input('backup_name');

   Backup::restore($backup_name);

   return redirect()->route('admin-backups')->with('success', 'The Backup has been restored successfully.');
}

public function deleteBackup(Request $request)
{
   $this->validate($request, [
    'backup_name'      => 'min:4',
    ]);

   $backup_name = $request->input('backup_name');

   File::delete($backup_name);

   return redirect()->route('admin-backups')->with('info', 'The Backup has been deleted successfully.');
}
}
