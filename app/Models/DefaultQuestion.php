<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultQuestion extends Model
{
    use HasFactory;

    protected $table = 'defaultquestion';

    protected $fillable = [
        'defquestion',
    ];
}
