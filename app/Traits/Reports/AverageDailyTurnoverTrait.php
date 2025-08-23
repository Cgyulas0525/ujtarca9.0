<?php

namespace App\Traits\Reports;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Models\Closures;

trait AverageDailyTurnoverTrait
{
    public function AverageDailyTurnover(Request $request, $begin, $end)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = Closures::selectRaw('weekday(closuredate) nap, (Sum(dailysum - 20000) / Sum(1)) osszeg')
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$begin, $end])
            ->groupBy('nap')
            ->orderby('nap')
            ->get();


        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('riports.RevenueExpenditureMonthIndex', ['data' => $data]);
    }
}
