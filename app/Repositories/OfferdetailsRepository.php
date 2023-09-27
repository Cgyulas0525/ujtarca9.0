<?php

namespace App\Repositories;

use App\Models\Offerdetails;
use App\Repositories\BaseRepository;

class OfferdetailsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'offers_id',
        'products_id',
        'quantities_id',
        'value'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Offerdetails::class;
    }
}
