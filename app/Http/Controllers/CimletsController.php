<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCimletsRequest;
use App\Http\Requests\UpdateCimletsRequest;
use App\Repositories\CimletsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Cimlets;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class CimletsController extends AppBaseController
{
    /** @var CimletsRepository $cimletsRepository*/
    private $cimletsRepository;

    public function __construct(CimletsRepository $cimletsRepo)
    {
        $this->cimletsRepository = $cimletsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('cimlets.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Cimlets', $row["id"], 'cimlets']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Cimlets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->cimletsRepository->all();
                return $this->dwData($data);

            }

            return view('cimlets.index');
        }
    }

    /**
     * Show the form for creating a new Cimlets.
     *
     * @return Response
     */
    public function create()
    {
        return view('cimlets.create');
    }

    /**
     * Store a newly created Cimlets in storage.
     *
     * @param CreateCimletsRequest $request
     *
     * @return Response
     */
    public function store(CreateCimletsRequest $request)
    {
        $input = $request->all();

        $cimlets = $this->cimletsRepository->create($input);

        return redirect(route('cimlets.index'));
    }

    /**
     * Display the specified Cimlets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        return view('cimlets.show')->with('cimlets', $cimlets);
    }

    /**
     * Show the form for editing the specified Cimlets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        return view('cimlets.edit')->with('cimlets', $cimlets);
    }

    /**
     * Update the specified Cimlets in storage.
     *
     * @param int $id
     * @param UpdateCimletsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCimletsRequest $request)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        $cimlets = $this->cimletsRepository->update($request->all(), $id);

        return redirect(route('cimlets.index'));
    }

    /**
     * Remove the specified Cimlets from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        $this->cimletsRepository->delete($id);

        return redirect(route('cimlets.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + cimlets::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields() {
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control','maxlength' => 100]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('value', 'Érték:'),
            "field" => Form::number('value', null, ['class' => 'form-control']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('description', 'Megjegyzés:'),
            "field" => Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4, 'id' => 'description']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        return $formGroupArray;
    }
}



