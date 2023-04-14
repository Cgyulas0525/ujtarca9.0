<?php

namespace App\Actions;

use App\Events\SendMail;
use App\Models\Offerdetails;
use App\Models\Offers;
use App\Models\Partners;
use PDF;

class OfferPdfAction
{

    public $offer;
    public $owner;
    public $partner;
    public $details;

    public function __construct($offer, $owner, $partner, $details) {
        $this->offer = $offer;
        $this->owner = $owner;
        $this->partner = $partner;
        $this->details = $details;
    }

    public function handle() {

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.offerPrintingEmail', ['offer' => $this->offer, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);

        $fileName = $this->partner->name . '-' . $this->offer->offernumber . '-' . date('Y-m-d',strtotime('today')) .'-megrendelés.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path);

        return $path;

    }

}
