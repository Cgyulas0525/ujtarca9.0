<?php

namespace App\Repositories;

use App\Models\Quantities;
use App\Repositories\BaseRepository;

/**
 * Class QuantitiesRepository
 * @package App\Repositories
 * @version February 2, 2023, 8:57 am UTC
*/

class QuantitiesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Quantities::class;
    }
}
