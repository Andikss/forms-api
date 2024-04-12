<?php

namespace App\Http\Controllers\Main;

use App\Exceptions\ExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\DTO\FormDTO;
use App\Http\Repositories\Main\Form\FormRepository;
use App\Http\Requests\Main\Form\StoreRequest;
use App\Http\Services\Helper\Helper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class FormController extends Controller
{
    protected $formRepository;

    public function __construct()
    {
        $this->formRepository = new FormRepository();
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $authenticatedUserId = Auth::user()->id;
            $form = $this->formRepository->get($authenticatedUserId);

            return response()->json([
                'message' => 'Get all form success',
                'form'    => $form
            ], 200);
        } catch (Exception $error) {
            return ExceptionHandler::handle($error);
        }
    }

    public function detail(string $form_slug): JsonResponse
    {
        try {
            $form = $this->formRepository->detail($form_slug);

            if (!Helper::isDomainAllowed($form)) {
                return response()->json(['message' => 'Forbidden access'], 403);
            }

            return response()->json([
                'message' => 'Get form success',
                'form'    => $form
            ], 200);
        } catch (Throwable $error) {
            return ExceptionHandler::handle($error);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $formDTO = new FormDTO(
                $request->name,
                $request->slug,
                $request->limit_one_response,
                Auth::user()->id,
                $request->allowed_domains,
                $request->description
            );

            $newForm = $this->formRepository->store($formDTO);

            return response()->json([
                'message' => 'Create form success',
                'form'    => $newForm
            ], 201);
        } catch (Exception $error) {
            return ExceptionHandler::handle($error);
        }
    }
}
