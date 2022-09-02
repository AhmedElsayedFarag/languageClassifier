<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileClassifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'lang',
        'name',
    ];
}
