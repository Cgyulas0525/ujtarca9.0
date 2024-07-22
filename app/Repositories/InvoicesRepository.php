<?php

namespace App\Repositories;

use App\Models\Invoices;
use App\Repositories\BaseRepository;

/**
 * Class InvoicesRepository
 * @package App\Repositories
 * @version January 2, 2023, 4:01 pm UTC
*/

class InvoicesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'partner_id',
        'invoicenumber',
        'paymentmethod_id',
        'amount',
        'dated',
        'performancedate',
        'deadline',
        'description',
        'referred_date'
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
        return Invoices::class;
    }
}
