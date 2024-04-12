<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }

    public static function getQuestionByColumn(string $key, string|int $value): ?Question {
        $form = self::where($key, $value)->first();
        if (!$form) {
            throw new ModelNotFoundException("Question not found");
        }
    
        return $form;
    }
}
