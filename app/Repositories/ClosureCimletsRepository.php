<?php

namespace App\Repositories;

use App\Models\ClosureCimlets;
use App\Repositories\BaseRepository;

/**
 * Class ClosureCimletsRepository
 * @package App\Repositories
 * @version January 2, 2023, 4:01 pm UTC
*/

class ClosureCimletsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'closures_id',
        'cimlets_id',
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
        return ClosureCimlets::class;
    }
}
