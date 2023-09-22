<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClosuresRequest;
use App\Http\Requests\UpdateClosuresRequest;
use App\Repositories\ClosuresRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Closures;
use App\Models\ClosureCimlets;
use App\Models\Cimlets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;
use Auth;
use DataTables;
use Form;
use App\Services\ClosureCimletInsert;
use Illuminate\Support\Facades\Redis;

class ClosuresController extends AppBaseController
{
    private $closuresRepository;
    private $maxId;

    public function __construct(ClosuresRepository $closuresRepo)
    {
        $this->closuresRepository = $closuresRepo;
        $this->maxId = Closures::all()->max('id');
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('closureValue', function ($data) {
                return ($data->dailysum - 20000);
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                if ($this->maxId == $row->id) {
                    $btn = '<a href="' . route('closures.edit', [$row->id]) . '"
                                 class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                    $btn = $btn . '<a href="' . route('beforeDestroys', ['Closures', $row->id, 'closures']) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getRedis($redis, $year)
    {
        if ($year == 0) {
            return $redis->get('closures_all');
        } else {
            return $redis->get('closures_' . $year);
        }
    }

    public function setRedis($redis, $year)
    {
        if ($year == 0) {
            $redis->setex('closures_all', 3600, Closures::all());
        } else {
            $redis->setex('closures_' . $year, 3600, Closures::whereYear('closuredate', $year)->get());
        }
    }

    public function index(Request $request, $year = null)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $redis = Redis::connection();
                $data = $this->getRedis($redis, $year);
                if (empty($data)) {
                    $this->setRedis($redis, $year);
                    $data = $this->getRedis($redis, $year);
                }
                return $this->dwData(json_decode($data));
            }
            return view('closures.index');
        }
    }

    public function create()
    {
        $closures = Closures::where('closuredate', \Carbon\Carbon::now()->toDateString())->first();
        if (!empty($closures)) {
            return view('closures.edit')->with('closures', $closures);
        }
        return view('closures.create');
    }

    public function store(CreateClosuresRequest $request)
    {
        $input = $request->all();
        $closures = $this->closuresRepository->create($input);
        if (ClosureCimlets::where('closures_id', $closures->id)->get()->count() == 0) {
            $cimlets = Cimlets::all();
            foreach ($cimlets as $cimlet) {
                $closurecimlet = new ClosureCimletInsert($cimlet->id, $closures->id);
                $closurecimlet->handle();
            }
        }
        return view('closures.edit')->with('closures', $closures);
    }

    public function show($id)
    {
        $closures = $this->closuresRepository->find($id);
        if (empty($closures)) {
            return redirect(route('closures.index'));
        }
        return view('closures.show')->with('closures', $closures);
    }

    public function edit($id)
    {
        $closures = $this->closuresRepository->find($id);
        if (empty($closures)) {
            return redirect(route('closures.index'));
        }
        return view('closures.edit')->with('closures', $closures);
    }

    public function update($id, UpdateClosuresRequest $request)
    {
        $closures = $this->closuresRepository->find($id);
        if (empty($closures)) {
            return redirect(route('closures.index'));
        }
        $closures = $this->closuresRepository->update($request->all(), $id);
        return redirect(route('closures.index'));
    }

    public function destroy($id)
    {
        $closures = $this->closuresRepository->find($id);
        if (empty($closures)) {
            return redirect(route('closures.index'));
        }
        $this->closuresRepository->delete($id);
        return redirect(route('closures.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + closures::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields($closures)
    {
        $formGroupArray = [];
        $item = ["label" => Form::label('closuredate', 'Dátum:'),
            "field" => Form::date('closuredate', isset($closures) ? $closures->closuredate : Carbon::now(), ['class' => 'form-control', 'id' => 'dated', 'required' => true, 'id' => 'closuredate']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('card', 'Kártya:'),
            "field" => Form::number('card', isset($closures) ? $closures->card : 0, ['class' => 'form-control text-right', 'required' => true, 'id' => 'card']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('szcard', 'Szép kártya:'),
            "field" => Form::number('szcard', isset($closures) ? $closures->szcard : 0, ['class' => 'form-control  text-right', 'required' => true, 'id' => 'szcard']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('dayduring', 'Napköz.:'),
            "field" => Form::number('dayduring', isset($closures) ? $closures->dayduring : 0, ['class' => 'form-control  text-right', 'required' => true, 'id' => 'dayduring']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('dailysum', 'Összesen:'),
            "field" => Form::text('dailysum', isset($closures) ? $closures->dailysum : 0, ['class' => 'form-control  text-right', 'id' => 'dailysum', 'readonly' => 'true']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('out', 'Kivét:'),
            "field" => Form::text('out', isset($closures) ? ($closures->dailysum - ($closures->card + $closures->szcard + $closures->dayduring + 20000)) : 0, ['class' => 'form-control  text-right', 'id' => 'out', 'readonly' => 'true']),
            "width" => 2,
            "file" => false];
        array_push($formGroupArray, $item);

        return $formGroupArray;
    }
}



