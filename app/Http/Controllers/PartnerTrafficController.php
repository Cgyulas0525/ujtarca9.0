<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use DataTables;
use Auth;

class PartnerTrafficController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('paymentMethodName', function($data) { return ($data->paymentmethod->name); })
            ->addColumn('partnerName', function($data) { return ($data->partner->name); })
            ->make(true);
    }

    public function pTIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Invoices::with('paymentmethod')
                    ->with('partner')
                    ->whereYear('dated', date('Y'))
                    ->get();

                return $this->dwData($data);

            }

            return view('riports.PartnerTraffic');
        }
    }

    public function partnerTrafficIndex(Request $request, $begin, $end, $partner) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Invoices::with('paymentmethod')
                    ->with('partner')
                    ->where( function($query) use ($partner) {
                        if ($partner == -9999) {
                            $query->whereNotNull('partner_id');
                        } else {
                            $query->where('partner_id', $partner);
                        }
                    })
                    ->whereBetween( 'dated', [$begin, $end])
                    ->get();

                return $this->dwData($data);

            }

            return view('riports.PartnerTraffic');
        }
    }
    //
}
