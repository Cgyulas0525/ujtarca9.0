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
use Illuminate\Support\Facades\Redis;

class CimletsController extends AppBaseController
{
    private $cimletsRepository;
    private $redis;

    public function __construct(CimletsRepository $cimletsRepo)
    {
        $this->cimletsRepository = $cimletsRepo;
        $this->redis = Redis::connection();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('cimlets.edit', $row->id) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Cimlets', $row->id, 'cimlets']) . '"
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
                $data = $this->redis->get('cimlets_all');
                if (empty($data)) {
                    $this->redis->setex('cimlets_all', 3600, Cimlets::all());
                    $data = $this->redis->get('cimlets_all');
                }
                return $this->dwData(json_decode($data));
            }
        }
        return view('cimlets.index');
    }

    public function create()
    {
        return view('cimlets.create');
    }

    public function store(CreateCimletsRequest $request)
    {
        $input = $request->all();
        $cimlets = $this->cimletsRepository->create($input);
        $this->redis->setex('cimlets_all', 3600, Cimlets::all());

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
        $this->redis->setex('cimlets_all', 3600, Cimlets::all());

        return redirect(route('cimlets.index'));
    }

    public function destroy($id)
    {
        $cimlets = $this->cimletsRepository->find($id);
        if (empty($cimlets)) {
            return redirect(route('cimlets.index'));
        }
        $this->cimletsRepository->delete($id);
        $this->redis->setex('cimlets_all', 3600, Cimlets::all());

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
            "field" => Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100, 'required' => true]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('value', 'Érték:'),
            "field" => Form::number('value', null, ['class' => 'form-control', 'required' => true]),
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



