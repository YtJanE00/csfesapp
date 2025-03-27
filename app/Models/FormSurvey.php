<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurvey extends Model
{
    use HasFactory;

    protected $table = 'form_survey';

    protected $fillable = [
        'title_id',
        'name',
        'office',
        'contact_information',
        'question',
        'question_rate',
        'feedback',
        'feedback2',
        'remember_token'
    ];
}


