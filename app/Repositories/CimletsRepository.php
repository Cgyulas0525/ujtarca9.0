<?php

namespace App\Repositories;

use App\Models\Cimlets;
use App\Repositories\BaseRepository;

/**
 * Class CimletsRepository
 * @package App\Repositories
 * @version January 2, 2023, 3:04 pm UTC
*/

class CimletsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'value',
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
        return Cimlets::class;
    }
}
