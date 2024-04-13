<?php

namespace App\Http\Controllers\Main;

use App\Exceptions\ExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\DTO\ResponseDTO;
use App\Http\Repositories\Main\Response\ResponseRepository;
use App\Http\Requests\Main\Response\StoreRequest;
use App\Models\Main\Form;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ResponseController extends Controller
{
    public $responseRepository;

    public function __construct()
    {
        $this->responseRepository = new ResponseRepository();
    }

    public function index(string $form_slug): JsonResponse
    {
        try {
            $responses = $this->responseRepository->index($form_slug);

            return response()->json([
                'message'   => 'Get responses success',
                'responses' => $responses
            ], 200);
        } catch (Throwable $error) {
            return ExceptionHandler::handle($error);
        }
    }

    public function store(StoreRequest $request, string $form_slug): JsonResponse
    {
        try {
            $responseDTO = new ResponseDTO(
                $request->answers,
                Form::getFormByColumn('slug', $form_slug)->id,
                Auth::user()->id,
                Carbon::now()
            );

            $this->responseRepository->store($responseDTO);

            return response()->json(['message' => 'Submit response success'], 201);
        } catch (Throwable $error) {
            return ExceptionHandler::handle($error);
        }
    }
}
