<?php

namespace App\Repositories;

use App\Models\Orderdetails;
use App\Repositories\BaseRepository;

class OrderdetailsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'orders_id',
        'products_id',
        'quantities_id',
        'value'

    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Orderdetails::class;
    }
}
