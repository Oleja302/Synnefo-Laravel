<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'file'; 

    
    protected $fillable = [
        'storageId',
        'path',
        'typeId',
     ]; 
     
     protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo('App\Models\FileType', 'typeId');
    } 
}
