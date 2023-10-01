<?php

namespace App\Repositories;

use App\Models\Partners;
use App\Repositories\BaseRepository;

/**
 * Class PartnersRepository
 * @package App\Repositories
 * @version January 2, 2023, 4:01 pm UTC
*/

class PartnersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'partnertypes_id',
        'taxnumber',
        'bankaccount',
        'postcode',
        'settlement_id',
        'address',
        'email',
        'phonenumber',
        'description',
        'active',
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
        return Partners::class;
    }
}
