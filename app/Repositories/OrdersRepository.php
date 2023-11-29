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
        'order_status',
        'delivered_date',
        'ordertype',
        'detailsum',
        'delivery_id',
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
