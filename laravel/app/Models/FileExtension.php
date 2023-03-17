<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileExtension extends Model
{
    use HasFactory;

    protected $table = 'file_extension'; 

    protected $fillable = [
        'typeId', 
        'extension'
     ];
}
