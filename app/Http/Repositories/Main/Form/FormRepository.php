<?php

namespace App\Http\Repositories\Main\Form;

use App\Exceptions\ExceptionHandler;
use App\Http\DTO\FormDTO;
use App\Models\Main\AllowedDomain;
use App\Models\Main\Form;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

/**
 * Repository for handling form operations.
 * 
 * @author Andika Dwi Saputra || @Andikss
 * @created 11 May 2024
 */

class FormRepository implements FormRepositoryInterface
{
    public function get(int $user_id): Collection|Form|bool
    {
        try {
            return Form::where('creator_id', $user_id)->get();
        } catch (Exception $error) {
            throw new Exception('Error while retrieving forms: ' . $error->getMessage());
        }
    }

    public function detail(string $form_slug): Form
    {
        try {
            $form = Form::with(['questions'])->where('slug', $form_slug)->first();
            if (!$form) throw new ModelNotFoundException("Form not found");

            return $form;
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, "Error while retrieving form details");
        }
    }

    public function store(FormDTO $form): Form
    {
        try {
            $newForm = Form::create([
                'name'               => $form->name,
                'slug'               => $form->slug,
                'description'        => $form->description,
                'limit_one_response' => $form->limit_one_response,
                'creator_id'         => $form->creator_id,
            ]);

            foreach ($form->allowed_domains as $domain) {
                AllowedDomain::create([
                    'form_id' => $newForm->id,
                    'domain'  => $domain
                ]);
            }

            return $newForm;
        } catch (Exception $error) {
            throw new Exception('Error while creating new form: ' . $error->getMessage());
        }
    }
}