<?php

namespace App\Observers;

use App\Models\Closures;

use App\Actions\Average\CumulativeValuesDatabase;

class ClosuresObserver
{

    private $yad;

    public function __construct() {
        $this->yad = new CumulativeValuesDatabase();
    }
    /**
     * Handle the Closures "created" event.
     *
     * @param  \App\Models\Closures  $closures
     * @return void
     */
    public function created(Closures $closures)
    {
        $this->yad->handle();
    }

    /**
     * Handle the Closures "updated" event.
     *
     * @param  \App\Models\Closures  $closures
     * @return void
     */
    public function updated(Closures $closures)
    {
        $this->yad->handle();
    }

    /**
     * Handle the Closures "deleted" event.
     *
     * @param  \App\Models\Closures  $closures
     * @return void
     */
    public function deleted(Closures $closures)
    {
        $this->yad->handle();
    }

    /**
     * Handle the Closures "restored" event.
     *
     * @param  \App\Models\Closures  $closures
     * @return void
     */
    public function restored(Closures $closures)
    {
        //
    }

    /**
     * Handle the Closures "force deleted" event.
     *
     * @param  \App\Models\Closures  $closures
     * @return void
     */
    public function forceDeleted(Closures $closures)
    {
        //
    }
}
