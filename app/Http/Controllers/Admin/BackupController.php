<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Log;
use Artisan;
use Storage;
use Response;
use Exception;
use League\Flysystem\Adapter\Local;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'backups';
        if (!count(config('backup.backup.destination.disks'))) {
            dd(trans('backup.no_disks_configured'));
        }
        $this->data['backups'] = [];
        foreach (config('backup.backup.destination.disks') as $disk_name) {
            $disk = Storage::disk($disk_name);
            $adapter = $disk->getDriver()->getAdapter();
            $files = $disk->allFiles();

            // make an array of backup files, with their filesize and creation date
            foreach ($files as $k => $f) {
                // only take the zip files into account
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $this->data['backups'][] = [
                        'file_path'     => $f,
                        'file_name'     => str_replace('backups/', '', $f),
                        'file_size'     => $disk->size($f),
                        'last_modified' => $disk->lastModified($f),
                        'disk'          => $disk_name,
                        'download'      => ($adapter instanceof Local) ? true : false,
                    ];
                }
            }
        }
        return view('admin.backup',$this->data,compact(
            'title',
        ));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = notify('Backup created successfully');
        try {
            ini_set('max_execution_time', 600);

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $sysRoot = getenv('SystemRoot') ?: (getenv('WINDIR') ?: 'C:\Windows');
                putenv("SystemRoot={$sysRoot}");
                putenv("WINDIR={$sysRoot}");
                putenv("SYSTEMDRIVE=" . substr($sysRoot, 0, 2));
                $_ENV['SystemRoot'] = $sysRoot;
                $_SERVER['SystemRoot'] = $sysRoot;
            }

            Log::info('Backpack\BackupManager -- Called backup:run from admin interface');

            Artisan::call('backup:run');

            $output = Artisan::output();
            if (strpos($output, 'Backup failed because')) {
                preg_match('/Backup failed because(.*?)$/ms', $output, $match);
                $reason = isset($match[1]) ? trim($match[1]) : 'Unknown error';
                $notification = notify('Backup process failed: ' . $reason, 'danger');
                Log::error('Backup failed: ' . $reason . PHP_EOL . $output);
            } else {
                Log::info("BackupManager -- backup process has completed");
                $notification = notify('Backup created successfully');
            }
        } catch (Exception $e) {
            Log::error($e);

            $notification = notify('Backup error: ' . $e->getMessage(), 'danger');
            return back()->with($notification);
        }

        return back()->with($notification);
    }

    
    

    /**
     * Downloads a backup zip file.
     */
    public function download()
    {
        $disk = Storage::disk(request('disk', 'local'));
        $file_name = request('file_name');
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof Local) {
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            if ($disk->exists($file_name)) {
                return response()->download($storage_path.$file_name);
            } else {
                abort(404, trans('backup.backup_doesnt_exist'));
            }
        } else {
            abort(404, trans('backup.only_local_downloads_supported'));
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  file $file_name
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(request('disk', 'local'));

        if ($disk->exists($file_name)) {
            $disk->delete($file_name);
            $notification = notify('Backup deleted successfully');
            return back()->with($notification);
        } else {
            abort(404, trans('backup.backup_doesnt_exist'));
        }
    }
}
