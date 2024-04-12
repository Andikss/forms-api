<?php

namespace App\Http\DTO;

class QuestionDTO
{
    public string $form_slug;
    public string $name;
    public string $choice_type;
    public bool $is_required;
    public ?array $choices;

    public function __construct(
        string $form_slug,
        string $name,
        string $choice_type,
        bool $is_required,
        ?array $choices
    ) {
        $this->form_slug   = $form_slug;
        $this->name        = $name;
        $this->choice_type = $choice_type;
        $this->is_required = $is_required;
        $this->choices     = count($choices) > 0 ? $choices : null;
    }
}
