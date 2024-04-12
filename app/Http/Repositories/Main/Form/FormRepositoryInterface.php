<?php

namespace App\Http\Repositories\Main\Form;

use App\Http\DTO\FormDTO;
use App\Models\Main\Form;
use Illuminate\Database\Eloquent\Collection;

interface FormRepositoryInterface
{
    /**
     * Retrieve forms by user ID.
     *
     * @param int $user_id
     * @return Collection|Form|bool
     * @throws Exception
     */

    public function get(int $user_id): Collection|Form|bool;

    /**
     * Retrieve form detail by slug.
     *
     * @param string $form_slug
     * @return Form
     * @throws Exception
     * @throws ModelMotFoundException
     */

    public function detail(string $form_slug): Form;

    /**
     * Store a new form.
     * 
     * Description:
     * 1. Stores a new form based on the provided FormDTO.
     * 2. Stores all allowed domains associated with the form.
     * 
     * @param FormDTO $form The data transfer object containing information about the form.
     * @return Form The newly created form.
     * @throws Exception If an error occurs while creating the new form.
     */


    public function store(FormDTO $form): Form;
}
