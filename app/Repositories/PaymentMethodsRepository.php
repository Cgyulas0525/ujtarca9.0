<?php

namespace App\Repositories;

use App\Models\PaymentMethods;
use App\Repositories\BaseRepository;

/**
 * Class PaymentMethodsRepository
 * @package App\Repositories
 * @version January 2, 2023, 3:43 pm UTC
*/

class PaymentMethodsRepository extends BaseRepository
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
        return PaymentMethods::class;
    }
}
