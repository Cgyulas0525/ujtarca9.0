<?php

namespace App\Observers;

use App\Models\invoices;
use App\Actions\Observer\Invoices\CumulativeValuesDatabase;


class InvoicesObserver
{
    private $yad;

    public function __construct() {
        $this->yad = new CumulativeValuesDatabase();
    }

    /**
     * Handle the invoices "created" event.
     *
     * @param  \App\Models\invoices  $invoices
     * @return void
     */
    public function created(invoices $invoices)
    {
        $this->yad->handle();
    }

    /**
     * Handle the invoices "updated" event.
     *
     * @param  \App\Models\invoices  $invoices
     * @return void
     */
    public function updated(invoices $invoices)
    {
        $this->yad->handle();
    }

    /**
     * Handle the invoices "deleted" event.
     *
     * @param  \App\Models\invoices  $invoices
     * @return void
     */
    public function deleted(invoices $invoices)
    {
        $this->yad->handle();
    }

    /**
     * Handle the invoices "restored" event.
     *
     * @param  \App\Models\invoices  $invoices
     * @return void
     */
    public function restored(invoices $invoices)
    {
        //
    }

    /**
     * Handle the invoices "force deleted" event.
     *
     * @param  \App\Models\invoices  $invoices
     * @return void
     */
    public function forceDeleted(invoices $invoices)
    {
        //
    }
}
