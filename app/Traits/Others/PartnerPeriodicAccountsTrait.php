<?php

namespace App\Traits\Others;

use App\Models\Invoices;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Carbon\Carbon;

trait PartnerPeriodicAccountsTrait
{
    public function partnerPeriodicAccounts(Request $request, $partner, $months)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = Invoices::where('partner_id', $partner)
                    ->whereBetween('dated', [now()->subMonths($months)->toDateString(), now()->toDateString()])
                    ->get();
                return Datatables::of($data)
                    ->addColumn('paymentMethodName', function ($data) {
                        return ($data->paymentMethodName);
                    })
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('partners.index');
        }
    }
}
