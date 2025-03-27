<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingQuestion extends Model
{
    use HasFactory;

    protected $table = 'training_question';

    protected $fillable = [
        'title_id',
        'question',
        'question_rate',
        'remember_token'
    ];
}
