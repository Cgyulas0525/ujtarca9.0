<?php

namespace App\Actions;

use App\Events\SendMail;
use App\Models\Offerdetails;
use App\Models\Offers;
use App\Models\Partners;
use PDF;

class OrderPdfAction
{

    public $order;
    public $owner;
    public $partner;
    public $details;

    public function __construct($order, $owner, $partner, $details)
    {
        $this->order = $order;
        $this->owner = $owner;
        $this->partner = $partner;
        $this->details = $details;
    }

    public function handle(): string
    {

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.offerPrintingEmail', ['offer' => $this->order, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);

        $fileName = $this->partner->name . '-' . $this->order->ordernumber . '-' . now()->toDateString() . '-megrendelés.pdf';
        $path = public_path('print/' . $fileName);

        $pdf->save($path);

        return $path;

    }

}
