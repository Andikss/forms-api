<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'responses';
    protected $fillable   = [
        'form_id',
        'user_id',
        'date'
    ];
}
