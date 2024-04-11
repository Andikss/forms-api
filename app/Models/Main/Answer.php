<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'answers';
    protected $fillable   = [
        'response_id',
        'question_id',
        'value'
    ];
}
