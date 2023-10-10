<?php

namespace App\Repositories;

use App\Models\Orders;

class OrdersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'ordernumber',
        'orderdate',
        'partners_id',
        'description',
        'ordertype',
        'detailsum',
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
