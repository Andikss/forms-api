<?php

namespace App\Http\DTO;

class FormDTO
{
    public string $name;
    public string $slug;
    public bool $limit_one_response;
    public int $creator_id;
    public array $allowed_domains;
    public ?string $description;

    public function __construct(
        string $name,
        string $slug,
        bool $limit_one_response,
        int $creator_id,
        array $allowed_domains,
        ?string $description
    ) {
        $this->name               = $name;
        $this->slug               = $slug;
        $this->limit_one_response = $limit_one_response;
        $this->creator_id         = $creator_id;
        $this->allowed_domains    = $allowed_domains;
        $this->description        = $description;
    }
}
