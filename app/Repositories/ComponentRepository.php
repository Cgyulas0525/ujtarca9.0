<?php

namespace App\Repositories;

use App\Models\Component;
use App\Repositories\BaseRepository;

class ComponentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Component::class;
    }
}
