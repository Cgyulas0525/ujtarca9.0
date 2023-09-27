<?php

namespace App\Repositories;

use App\Models\Offers;
use App\Repositories\BaseRepository;

class OffersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'offernumber',
        'offerdate',
        'partners_id',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Offers::class;
    }
}
