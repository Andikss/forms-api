<?php

namespace App\Http\Repositories\Main\Response;

use App\Http\DTO\ResponseDTO;
use App\Models\Main\Form;
use App\Models\Main\Response;
use Illuminate\Database\Eloquent\Collection;

interface ResponseRepositoryInterface
{
    /**
     * Retrieve responses for a given form slug
     *
     * @param string $form_slug The slug of the form
     * @return Collection|Form
     * @throws Throwable If an error occurs during retrieval
     */

    public function index(string $form_slug): Collection|Form;

    /**
     * Store a new response
     *
     * @param ResponseDTO $response The DTO containing response data
     * @return Response The newly created response
     * @throws Throwable If an error occurs during submission
     */

    public function store(ResponseDTO $response): Response;
}
