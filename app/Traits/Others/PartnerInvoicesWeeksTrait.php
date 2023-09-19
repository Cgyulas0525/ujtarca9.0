<?php

namespace App\Traits\Others;

use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Auth;
use DataTables;

trait PartnerInvoicesWeeksTrait {

    public function partnerInvoicesWeeks(Request $request, $witch, $begin = null, $end = null, $partner = null) {

        if( Auth::check() ) {

            if ($request->ajax()) {

                $data = (new InvoiceService)->partnerInvoicesPeriod($witch, $begin, $end, $partner);

                return Datatables::of($data)
                    ->addColumn('paymentMethodName', function($data) { return ($data->paymentMethodName); })
                    ->addIndexColumn()
                    ->make(true);

            }

        }

        return view('partners.index');

    }
}
