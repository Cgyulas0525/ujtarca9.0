<?php

namespace App\Actions;

use App\Models\Products;
use PDF;

class ProductPdfAction
{
    public $owner;
    public $partner;

    public function __construct($owner, $partner) {
        $this->owner = $owner;
        $this->partner = $partner;
    }

    public function handle() {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.productsPrintingEmail', [ 'owner' => $this->owner,
                                                                'partner' => $this->partner,
                                                                'products' => Products::all()]);

        $fileName = $this->partner->name . '-' . date('Y-m-d',strtotime('today')) .'-pékáru.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path);

        return $path;
    }
}
