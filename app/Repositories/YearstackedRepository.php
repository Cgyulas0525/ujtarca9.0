<?php

namespace App\Repositories;

use App\Models\Yearstacked;
use App\Repositories\BaseRepository;

/**
 * Class YearstackedRepository
 * @package App\Repositories
 * @version April 12, 2023, 8:13 am UTC
*/

class YearstackedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year',
        'revenue',
        'spend'
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
        return Yearstacked::class;
    }
}
