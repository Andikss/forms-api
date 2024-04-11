<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'forms';
    protected $fillable   = [
        'name',
        'slug',
        'description',
        'limit_one_response',
        'creator_id'
    ];
}
