<?php

namespace App\Http\Repositories\Main\Question;

use App\Exceptions\ExceptionHandler;
use App\Http\DTO\QuestionDTO;
use App\Models\Main\Form;
use App\Models\Main\Question;
use Throwable;

class QuestionRepository
{
    public function store(QuestionDTO $question): Question
    {
        try {
            $relatedForm = Form::getFormByColumn('slug', $question->form_slug);
            $newQuestion = Question::create([
                'form_id'      => $relatedForm->id,
                'name'         => $question->name,
                'choice_type'  => $question->choice_type,
                'choices'      => $question->choices ?? null,
                'is_required'  => $question->is_required
            ]);

            return $newQuestion;
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, 'Error while creating new question');
        }
    }

    public function delete(int $id): bool
    {
        try {
            Question::getQuestionByColumn('id', $id)->delete();
            return true;
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, 'Error while deleting a question');
        }
    }
}
