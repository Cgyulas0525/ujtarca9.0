<?php
namespace App\Traits\Others;

use App\Models\Invoices;
use Illuminate\Http\Request;
use Auth;
use DataTables;

trait PartnerFactSheetTrait {

    public function partnerFactSheet(Request $request, $partner, $year) {

        if( Auth::check() ) {

            if ($request->ajax()) {

                $data = Invoices::PartnerYearInvoices($partner, $year)->get();

                return Datatables::of($data)
                    ->addColumn('paymentMethodName', function($data) { return ($data->paymentMethodName); })
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('partners.index');
        }

    }
}
