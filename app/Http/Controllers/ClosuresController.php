<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClosuresRequest;
use App\Http\Requests\UpdateClosuresRequest;
use App\Repositories\ClosuresRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Closures;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class ClosuresController extends AppBaseController
{
    /** @var ClosuresRepository $closuresRepository*/
    private $closuresRepository;

    public function __construct(ClosuresRepository $closuresRepo)
    {
        $this->closuresRepository = $closuresRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('closureValue', function($data) { return ($data->card + $data->szcard + $data->dayduring + $data->closureValue - 20000); })
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('closures.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Closures', $row->id, 'closures']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Closures.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('closurecimlets as t1')
                    ->join('closures as t2', 't2.id', '=', 't1.closures_id')
                    ->join('cimlets as t3', 't3.id', '=', 't1.cimlets_id')
                    ->select('t2.id', 't2.closuredate', 't2.card', 't2.szcard', 't2.dayduring', DB::raw('sum(t3.value * t1.value) as closureValue'))
                    ->groupBy('t2.id', 't2.card', 't2.szcard', 't2.dayduring')
                    ->get();

                return $this->dwData($data);

            }

            return view('closures.index');
        }
    }

    /**
     * Show the form for creating a new Closures.
     *
     * @return Response
     */
    public function create()
    {
        return view('closures.create');
    }

    /**
     * Store a newly created Closures in storage.
     *
     * @param CreateClosuresRequest $request
     *
     * @return Response
     */
    public function store(CreateClosuresRequest $request)
    {
        $input = $request->all();

        $closures = $this->closuresRepository->create($input);

        return redirect(route('closures.index'));
    }

    /**
     * Display the specified Closures.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $closures = $this->closuresRepository->find($id);

        if (empty($closures)) {
            return redirect(route('closures.index'));
        }

        return view('closures.show')->with('closures', $closures);
    }

    /**
     * Show the form for editing the specified Closures.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $closures = $this->closuresRepository->find($id);

        if (empty($closures)) {
            return redirect(route('closures.index'));
        }

        return view('closures.edit')->with('closures', $closures);
    }

    /**
     * Update the specified Closures in storage.
     *
     * @param int $id
     * @param UpdateClosuresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClosuresRequest $request)
    {
        $closures = $this->closuresRepository->find($id);

        if (empty($closures)) {
            return redirect(route('closures.index'));
        }

        $closures = $this->closuresRepository->update($request->all(), $id);

        return redirect(route('closures.index'));
    }

    /**
     * Remove the specified Closures from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $closures = $this->closuresRepository->find($id);

        if (empty($closures)) {
            return redirect(route('closures.index'));
        }

        $this->closuresRepository->delete($id);

        return redirect(route('closures.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + closures::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields($closures) {
        $formGroupArray = [];
        $item = ["label" => Form::label('closuredate', 'Dátum:'),
                "field" => Form::date('closuredate', isset($closures) ? $closures->closuredate : Carbon::now(), ['class' => 'form-control','id'=>'dated', 'required' => true, 'id' => 'closuredate']),
                "width" => 2,
                "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('card', 'Kártya:'),
                "field" => Form::number('card', isset($closures) ? $closures->card : 0, ['class' => 'form-control text-right', 'id' => 'card']),
                "width" => 2,
                "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('szcard', 'Szép kártya:'),
            "field" => Form::number('szcard', isset($closures) ? $closures->szcard : 0, ['class' => 'form-control  text-right', 'id' => 'szcard']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('dayduring', 'Napköz.:'),
            "field" => Form::number('dayduring', isset($closures) ? $closures->dayduring : 0, ['class' => 'form-control  text-right', 'id' => 'dayduring']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('sum', 'Összesen:'),
            "field" => Form::text('sum', 0, ['class' => 'form-control  text-right', 'id' => 'sum', 'readonly' => 'true']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('out', 'Kivét:'),
            "field" => Form::text('out', 0, ['class' => 'form-control  text-right', 'id' => 'out', 'readonly' => 'true']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        return $formGroupArray;
    }
}



