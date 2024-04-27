<?php

namespace App\Http\DTO;

class QuestionDTO
{
    public string $form_slug;
    public string $name;
    public string $choice_type;
    public bool $is_required;
    public ?string $choices;
    public ?int $id;

    public function __construct(
        string $form_slug,
        string $name,
        string $choice_type,
        bool $is_required,
        ?array $choices,
        ?int $id = null
    ) {
        $this->form_slug = $form_slug;
        $this->name = $name;
        $this->choice_type = $choice_type;
        $this->is_required = $is_required;
        $this->choices = $choices ? implode(',', $choices) : null;
        $this->id = $id;
    }
}
