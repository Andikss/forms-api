<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllowedDomain extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table      = 'allowed_domains';
    protected $fillable   = [
        'form_id',
        'domain'
    ];

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class, 'form_id', 'id');
    }
}
