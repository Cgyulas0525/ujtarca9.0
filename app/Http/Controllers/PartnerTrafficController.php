<?php

namespace App\Http\Controllers;

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
            ->make(true);
    }

    public function pTIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('invoices')
                    ->join('paymentmethods', 'paymentmethods.id', '=', 'invoices.paymentmethod_id')
                    ->join('partners', 'partners.id', '=', 'invoices.partner_id')
                    ->select('invoices.*', 'paymentmethods.name as paymentMethodName', 'partners.name as partnerName')
                    ->whereNull('invoices.deleted_at')
                    ->where(DB::raw('year(invoices.dated)'), date('Y'))
                    ->get();
                return $this->dwData($data);

            }

            return view('riports.PartnerTraffic');
        }
    }

    public function partnerTrafficIndex(Request $request, $begin, $end, $partner) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('invoices')
                    ->join('paymentmethods', 'paymentmethods.id', '=', 'invoices.paymentmethod_id')
                    ->join('partners', 'partners.id', '=', 'invoices.partner_id')
                    ->select('invoices.*', 'paymentmethods.name as paymentMethodName', 'partners.name as partnerName')
                    ->whereNull('invoices.deleted_at')
                    ->where( function($query) use ($partner) {
                        if ($partner == -9999) {
                            $query->whereNotNull('invoices.partner_id');
                        } else {
                            $query->where('invoices.partner_id', '=', $partner);
                        }
                    })
                    ->whereBetween( 'invoices.dated', [$begin, $end])
                    ->get();
                return $this->dwData($data);

            }

            return view('riports.PartnerTraffic');
        }
    }
    //
}
