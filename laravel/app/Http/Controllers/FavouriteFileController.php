<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\File;
use App\Models\FavouriteFile; 
use ZipArchive;

class FavouriteFileController extends Controller
{
    public function downloadFile(Request $request)
    { 
        $zip = new ZipArchive; 
        $fileName = 'temp.zip'; 
        
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        { 
            foreach ($request->filesID as $key => $id) {
                $path = FavouriteFile::where('id',$id)->first()->path;
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
        $file =  FavouriteFile::where('id',$request->id)->first(); 
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
            $file = FavouriteFile::where('id',$value)->first(); 
            $copyFile = $file->replicate(); 

            $copyFile->setTable('remove_file');
            $copyFile->save();

            unlink(storage_path('app/'. $file->path));
            $file->delete(); 
        }

        $lc = new LogController();
        $lc->deleteFile(count($request->all()));
    }

    public function unfavourite(Request $request)
    { 
        foreach ($request->all() as $id) {   
            $file = FavouriteFile::where('id',$id)->first(); 
            if (!File::where('path', $file->path)->update(['updated_at' => now()])) {   
                $copyFile = $file->replicate(); 
                $copyFile->setTable('file');
                $copyFile->save();
            }
            $file->delete(); 
        }

        $lc = new LogController();
        $lc->unfavourite(count($request->all()));
    } 
}
