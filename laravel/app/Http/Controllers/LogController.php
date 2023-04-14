<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function uploadFile($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Upload {$count} files", 
        ]);
    }

    public function uploadFolder($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Upload folder with {$count} files", 
        ]);
    }

    public function downloadFile($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Download {$count} files", 
        ]);
    }

    public function renameFile()
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Rename file", 
        ]);
    }

    public function deleteFile($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Delete {$count} files", 
        ]);
    }

    public function favouriteFile($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Add to favourite {$count} files", 
        ]);
    }

    public function unfavourite($count)
    {
        Log::create([
            'userId' => auth()->id(),
            'description' => "Remove from favourite {$count} files", 
        ]);
    } 
}
