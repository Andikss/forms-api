<?php

namespace App\Http\DTO;

class ResponseDTO
{

    public array $answers;
    public int $form_id;
    public int $user_id;
    public string $date;

    public function __construct(
        array $answers,
        int $form_id,
        int $user_id,
        string $date
    ) {
        $this->answers = $answers;
        $this->form_id = $form_id;
        $this->user_id = $user_id;
        $this->date    = $date;
    }
}
