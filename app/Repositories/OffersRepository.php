<?php

namespace App\Repositories;

use App\Models\Offers;
use App\Repositories\BaseRepository;

/**
 * Class OffersRepository
 * @package App\Repositories
 * @version February 3, 2023, 11:19 am UTC
*/

class OffersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offernumber',
        'offerdate',
        'partners_id',
        'description'
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
        return Offers::class;
    }
}
