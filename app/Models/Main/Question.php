<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'questions';
    protected $fillable   = [
        'form_id',
        'name',
        'choice_type',
        'choices',
        'is_required'
    ];
}
