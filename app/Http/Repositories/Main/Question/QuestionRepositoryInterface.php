<?php

namespace App\Http\Repositories\Main\Question;

use App\Http\DTO\QuestionDTO;
use App\Models\Main\Question;

interface QuestionRepositoryInterface
{

    /**
     * Store a new question using @param QuestionDTO
     *
     * @param QuestionDTO 
     * @return Question new created question
     * @throws Throwable
     */

    public function store(QuestionDTO $question): Question;

    /**
     * Method to delete a question by its ID
     *
     * @param int $id The ID of the question to be deleted.
     * @throws Throwable If an error occurs while deleting the question.
     * @return bool
     */

    public function delete(int $id): bool;
}
