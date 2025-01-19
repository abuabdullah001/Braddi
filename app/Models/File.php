<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'sr_no',
        'name',
        'category',
        'meta_tags',
        'file_url',
        'file_name',
        'file_path',
    ];
}
