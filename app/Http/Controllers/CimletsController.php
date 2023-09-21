<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCimletsRequest;
use App\Http\Requests\UpdateCimletsRequest;
use App\Repositories\CimletsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Cimlets;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Form;

class CimletsController extends AppBaseController
{
    /** @var CimletsRepository $cimletsRepository */
    private $cimletsRepository;

    public function __construct(CimletsRepository $cimletsRepo)
    {
        $this->cimletsRepository = $cimletsRepo;
    }

    public function dwData($data): object
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('cimlets.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Cimlets', $row["id"], 'cimlets']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = $this->cimletsRepository->all();
                return $this->dwData($data);
            }
            return view('cimlets.index');
        }
    }

    public function create()
    {
        return view('cimlets.create');
    }

    public function store(CreateCimletsRequest $request)
    {
        $input = $request->all();

        $cimlets = $this->cimletsRepository->create($input);

        return redirect(route('cimlets.index'));
    }

    public function show($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        return view('cimlets.show')->with('cimlets', $cimlets);
    }

    public function edit($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        return view('cimlets.edit')->with('cimlets', $cimlets);
    }

    public function update($id, UpdateCimletsRequest $request)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        $cimlets = $this->cimletsRepository->update($request->all(), $id);

        return redirect(route('cimlets.index'));
    }

    public function destroy($id)
    {
        $cimlets = $this->cimletsRepository->find($id);

        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }

        $this->cimletsRepository->delete($id);

        return redirect(route('cimlets.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + cimlets::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields(): array
    {
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('value', 'Érték:'),
            "field" => Form::number('value', null, ['class' => 'form-control']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('description', 'Megjegyzés:'),
            "field" => Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 500, 'rows' => 4, 'id' => 'description']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        return $formGroupArray;
    }
}



