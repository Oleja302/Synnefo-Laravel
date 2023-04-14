<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FavouriteFile;
use App\Models\File;
use App\Models\FileExtension;
use App\Models\RemoveFile;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use ZipArchive;


class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        foreach ($request->file('files') as $file) {
            $file->storeAs('users/' . auth()->id(), $file->getClientOriginalName());
            $ext = FileExtension::where('extension', $file->extension())->first();

            if (!File::where('path', 'users/' . auth()->id() . '/' . $file->getClientOriginalName())->
                update(['updated_at' => now()])) {
                if ($ext) {
                    File::create([
                        'storageId' => Storage::where('userId', auth()->id())->first()->id,
                        'path' => 'users/' . auth()->id() . '/' . $file->getClientOriginalName(),
                        'typeId' => $ext->typeId,
                    ]);
                } else {
                    File::create([
                        'storageId' => Storage::where('userId', auth()->id())->first()->id,
                        'path' => 'users/' . auth()->id() . '/' . $file->getClientOriginalName(),
                        'typeId' => 1,
                    ]);
                }
            }
        }

        $lc = new LogController();
        $lc->uploadFile(count($request->file('files')));
    }

    public function uploadFolder(Request $request)
    {
        foreach (array_map(null, $request->file('files'), explode(',', $request->paths)) as list($file, $path)) {
            $file->storeAs('users/' . auth()->id(), $path);
            $ext = FileExtension::where('extension', $file->extension())->first();

            if (!File::where('path', 'users/' . auth()->id() . '/' . $path)->
                update(['updated_at' => now()])) {
                if ($ext) {
                    File::create([
                        'storageId' => Storage::where('userId', auth()->id())->first()->id,
                        'path' => 'users/' . auth()->id() . '/' . $path,
                        'typeId' => $ext->typeId,
                    ]);
                } else {
                    File::create([
                        'storageId' => Storage::where('userId', auth()->id())->first()->id,
                        'path' => 'users/' . auth()->id() . '/' . $path,
                        'typeId' => 1,
                    ]);
                }
            }
        } 

        $lc = new LogController();
        $lc->uploadFolder(count($request->file('files')));
    }

    public function downloadFile(Request $request)
    { 
        $zip = new ZipArchive; 
        $fileName = 'temp.zip'; 
        
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        { 
            foreach ($request->filesID as $id) {
                $path = File::where('id',$id)->first()->path;
                $relativeNameInZipFile = basename($path);
                $zip->addFile(storage_path('app/'. $path), $relativeNameInZipFile);
            }

            $zip->close();
        } 

        $lc = new LogController();
        $lc->downloadFile(count($request->filesID));

        return response()->download(public_path($fileName))->deleteFileAfterSend(true); 
    }

    public function renameFile(Request $request)
    { 
        $file =  File::where('id',$request->id)->first(); 
        $newPath = pathinfo($file->path)['dirname'].'/'.$request->name;
        rename(storage_path('app/'. $file->path), storage_path('app/'. $newPath));
        $file->path = $newPath; 
        $file->save(); 

        $lc = new LogController();
        $lc->renameFile();
    }

    public function deleteFile(Request $request)
    { 
        foreach ($request->all() as $value) {    
            $file = File::where('id',$value)->first(); 
            $copyFile = $file->replicate(); 

            $copyFile->setTable('remove_file');
            $copyFile->save();

            unlink(storage_path('app/'. $file->path));
            $file->delete(); 
        }

        $lc = new LogController();
        $lc->deleteFile(count($request->all()));
    }

    public function favouriteFile(Request $request)
    { 
        foreach ($request->all() as $id) {   
            $file = File::where('id',$id)->first(); 

            if (!FavouriteFile::where('path', $file->path)->update(['updated_at' => now()])) { 
                $copyFile = $file->replicate(); 
                $copyFile->setTable('favourite_file');
                $copyFile->save();
            }
            $file->delete(); 
        }

        $lc = new LogController();
        $lc->favouriteFile(count($request->all()));
    } 
}
