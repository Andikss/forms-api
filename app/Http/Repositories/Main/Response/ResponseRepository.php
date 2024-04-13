<?php

namespace App\Http\Repositories\Main\Response;

use App\Exceptions\ExceptionHandler;
use App\Http\DTO\ResponseDTO;
use App\Models\Main\Answer;
use App\Models\Main\Form;
use App\Models\Main\Response;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Repository for handling response operations.
 * 
 * @package App\Http\Repositories\Main\Response
 * @author Andika Dwi Saputra || @Andikss
 * @created 12 May 2024
 */

class ResponseRepository implements ResponseRepositoryInterface
{
    public function index(string $form_slug): Collection|Form
    {
        try {
            return Form::with(['responses.user', 'responses.answers'])
                ->where('slug', $form_slug)
                ->get();
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, 'Error while retrieving responses');
        }
    }

    public function store(ResponseDTO $response): Response
    {
        try {
            $newResponse = Response::create([
                'form_id' => $response->form_id,
                'user_id' => $response->user_id,
                'date'    => $response->date
            ]);

            foreach ($response->answers as $answer) {
                Answer::create([
                    'response_id' => $newResponse->id,
                    'question_id' => $answer['question_id'],
                    'value'       => $answer['value']
                ]);
            }

            return $newResponse;
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, 'Error while submitting a response');
        }
    }
}
