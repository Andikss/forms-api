<?php

namespace App\Models\Main;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'form_id', 'id');
    }

    public function domains(): HasMany
    {
        return $this->hasMany(AllowedDomain::class, 'form_id', 'id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'form_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public static function getFormByColumn(string $key, string|int $value): ?Form {
        $form = self::where($key, $value)->first();
        if (!$form) {
            throw new ModelNotFoundException("Form not found");
        }
    
        return $form;
    }
}
