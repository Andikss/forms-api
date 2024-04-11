<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class, 'response_id', 'id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
