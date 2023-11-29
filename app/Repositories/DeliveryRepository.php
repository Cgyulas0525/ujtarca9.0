<?php

namespace App\Repositories;

use App\Models\Delivery;
use App\Repositories\BaseRepository;

class DeliveryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'delivery_number',
        'date',
        'location_id',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Delivery::class;
    }
}
