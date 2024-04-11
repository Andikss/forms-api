<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedDomain extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'allowed_domains';
    protected $fillable   = [
        'form_is',
        'user_id',
        'domain'
    ];
}
