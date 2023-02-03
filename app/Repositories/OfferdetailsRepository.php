<?php

namespace App\Repositories;

use App\Models\Offerdetails;
use App\Repositories\BaseRepository;

/**
 * Class OfferdetailsRepository
 * @package App\Repositories
 * @version February 3, 2023, 11:21 am UTC
*/

class OfferdetailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offers_id',
        'products_id',
        'quantities_id',
        'value'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Offerdetails::class;
    }
}
