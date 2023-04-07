<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    }

    public function downloadFile(Request $request)
    { 
        $zip = new ZipArchive; 
        $fileName = 'temp.zip'; 
        
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        { 
            foreach ($request->filesID as $key => $id) {
                $path = File::where('id',$id)->first()->path;
                $relativeNameInZipFile = basename($path);
                $zip->addFile(storage_path('app/'. $path), $relativeNameInZipFile);
            }

            $zip->close();
        } 

        return response()->download(public_path($fileName))->deleteFileAfterSend(true); 
    }

    public function renameFile(Request $request)
    { 
        $file =  File::where('id',$request->id)->first(); 
        $newPath = pathinfo($file->path)['dirname'].'/'.$request->name;
        rename(storage_path('app/'. $file->path), storage_path('app/'. $newPath));
        $file->path = $newPath; 
        $file->save(); 
    }

    public function deleteFile(Request $request)
    { 
        foreach ($request->all() as $value) {    
            $file = File::where('id',$value)->first(); 
            $copyFile = $file->replicate(); 

            $copyFile->setTable('remove_file');
            $copyFile->save();

            $file->delete(); 
        }
    }

    public function favouriteFile(Request $request)
    { 
        foreach ($request->all() as $value) {   
            $file = File::where('id',$value)->first(); 
            $copyFile = $file->replicate(); 

            $copyFile->setTable('favourite_file');
            $copyFile->save();

            $file->delete(); 
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
