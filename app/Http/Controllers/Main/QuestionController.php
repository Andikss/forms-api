<?php

namespace App\Http\Controllers\Main;

use App\Exceptions\ExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\DTO\QuestionDTO;
use App\Http\Repositories\Main\Question\QuestionRepository;
use App\Http\Requests\Main\Question\StoreRequest;
use App\Models\Main\Form;
use Illuminate\Support\Facades\Auth;
use Throwable;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct()
    {
        $this->questionRepository = new QuestionRepository();
    }

    public function store(StoreRequest $request, string $form_slug)
    {
        try {

            $form = Form::getFormByColumn('slug', $form_slug);
            if ($form->creator_id !== Auth::user()->id) {
                return response()->json(['message' => 'Forbidden access'], 403);
            }

            $questionDTO = new QuestionDTO(
                $form_slug,
                $request->name,
                $request->choice_type,
                $request->is_required,
                $request->choices
            );

            $newQuestion = $this->questionRepository->store($questionDTO);

            return response()->json([
                'message'  => 'Add question success',
                'question' => $newQuestion
            ], 201);
        } catch (Throwable $error) {
            return ExceptionHandler::handle($error);
        }
    }

    public function delete(string $form_slug, int $question_id)
    {
        try {

            $form = Form::getFormByColumn('slug', $form_slug);
            if ($form->creator_id !== Auth::user()->id) {
                return response()->json(['message' => 'Forbidden access'], 403);
            }

            $this->questionRepository->delete($question_id);

            return response()->json(['message'  => 'Remove question success'], 200);
        } catch (Throwable $error) {
            return ExceptionHandler::handle($error);
        }
    }
}
