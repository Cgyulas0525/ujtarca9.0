<?php

namespace App\Repositories;

use App\Models\Closures;
use App\Repositories\BaseRepository;

/**
 * Class ClosuresRepository
 * @package App\Repositories
 * @version January 2, 2023, 4:01 pm UTC
*/

class ClosuresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'closuredate',
        'card',
        'szcard',
        'dayduring'
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
        return Closures::class;
    }
}
