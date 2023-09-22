<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClosureCimletsRequest;
use App\Http\Requests\UpdateClosureCimletsRequest;
use App\Repositories\ClosureCimletsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\ClosureCimlets;
use Illuminate\Http\Request;
use Response;
use Auth;
use DataTables;

class ClosureCimletsController extends AppBaseController
{
    private $closureCimletsRepository;

    public function __construct(ClosureCimletsRepository $closureCimletsRepo)
    {
        $this->closureCimletsRepository = $closureCimletsRepo;
    }

    public function dwData($data): object
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cimletName', function ($data) {
                return $data->cimlets->name;
            })
            ->addColumn('cimletValue', function ($data) {
                return $data->cimlets->value;
            })
            ->addColumn('sumValue', function ($data) {
                return $data->cash;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = $this->closureCimletsRepository->all();
                return $this->dwData($data);
            }
            return view('closure_cimlets.index');
        }
    }

    public function closureCimletsIndex(Request $request, $id)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = ClosureCimlets::where('closures_id', $id)->get();
                return $this->dwData($data);
            }
            return view('closure_cimlets.index');
        }
    }

    public function create()
    {
        return view('closure_cimlets.create');
    }

    public function store(CreateClosureCimletsRequest $request)
    {
        $input = $request->all();
        $closureCimlets = $this->closureCimletsRepository->create($input);
        return redirect(route('closureCimlets.index'));
    }

    public function show($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);
        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }
        return view('closure_cimlets.show')->with('closureCimlets', $closureCimlets);
    }

    public function edit($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);
        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }
        return view('closure_cimlets.edit')->with('closureCimlets', $closureCimlets);
    }

    public function update($id, UpdateClosureCimletsRequest $request)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);
        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }
        $closureCimlets = $this->closureCimletsRepository->update($request->all(), $id);
        return redirect(route('closureCimlets.index'));
    }

    public function destroy($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);
        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }
        $this->closureCimletsRepository->delete($id);
        return redirect(route('closureCimlets.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + closureCimlets::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function closureCimletsUpdate(Request $request): mixed
    {
       ClosureCimlets::find($request->get('id'))->update(['value' => $request->get('value'),
            'updated_at' => \Carbon\Carbon::now()]);
        return Response::json(ClosureCimlets::find($request->get('id')));
    }

    public function closureCimletsSum(Request $request): int
    {
        return ClosureCimlets::closureclosurecimlets($request->get('id'))->get()->sum('cash');
    }
}



