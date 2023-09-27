<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\BaseRepository;

class OrdersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'ordernumber',
        'orderdate',
        'partners_id',
        'description'

    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Orders::class;
    }
}
