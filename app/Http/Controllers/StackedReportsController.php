<?php

namespace App\Http\Controllers;

use App\Repositories\MonthstackedRepository;
use App\Repositories\WeekstackedRepository;
use App\Repositories\YearstackedRepository;
use Auth;
use Illuminate\Http\Request;
use DataTables;

class StackedReportsController
{

    protected $yearstackedRepository, $monthstackedRepository, $weekstackedRepository;

    public function __construct(YearstackedRepository $yearstackedRepository,
                                MonthstackedRepository $monthstackedRepository,
                                WeekstackedRepository $weekstackedRepository)
    {
        $this->yearstackedRepository = $yearstackedRepository;
        $this->monthstackedRepository = $monthstackedRepository;
        $this->weekstackedRepository = $weekstackedRepository;
    }

    public function getMonthStackedLastYear()
    {
        $query = $this->monthstackedRepository->allQuery();

        return $query->orderBy('id', 'desc')->take(13)->get();
    }

    public function getWeekStackedLastYear()
    {
        $query = $this->weekstackedRepository->allQuery();

        return $query->orderBy('id', 'desc')->take(53)->get();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getMonthStackedIndex(Request $request)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        if ($request->ajax()) {
            return $this->dwData($this->getMonthStackedLastYear());
        }

        return view('stacked_report.month_stacked_index');
    }

}
