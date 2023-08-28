<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClosureCimletsRequest;
use App\Http\Requests\UpdateClosureCimletsRequest;
use App\Models\Closures;
use App\Repositories\ClosureCimletsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\ClosureCimlets;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class ClosureCimletsController extends AppBaseController
{
    /** @var ClosureCimletsRepository $closureCimletsRepository */
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


    /**
     * Display a listing of the ClosureCimlets.
     *
     * @param Request $request
     *
     * @return Response
     */
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

    /**
     * Show the form for creating a new ClosureCimlets.
     *
     * @return Response
     */
    public function create()
    {
        return view('closure_cimlets.create');
    }

    /**
     * Store a newly created ClosureCimlets in storage.
     *
     * @param CreateClosureCimletsRequest $request
     *
     * @return Response
     */
    public function store(CreateClosureCimletsRequest $request)
    {
        $input = $request->all();

        $closureCimlets = $this->closureCimletsRepository->create($input);

        return redirect(route('closureCimlets.index'));
    }

    /**
     * Display the specified ClosureCimlets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);

        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }

        return view('closure_cimlets.show')->with('closureCimlets', $closureCimlets);
    }

    /**
     * Show the form for editing the specified ClosureCimlets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);

        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }

        return view('closure_cimlets.edit')->with('closureCimlets', $closureCimlets);
    }

    /**
     * Update the specified ClosureCimlets in storage.
     *
     * @param int $id
     * @param UpdateClosureCimletsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClosureCimletsRequest $request)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);

        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }

        $closureCimlets = $this->closureCimletsRepository->update($request->all(), $id);

        return redirect(route('closureCimlets.index'));
    }

    /**
     * Remove the specified ClosureCimlets from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $closureCimlets = $this->closureCimletsRepository->find($id);

        if (empty($closureCimlets)) {
            return redirect(route('closureCimlets.index'));
        }

        $this->closureCimletsRepository->delete($id);

        return redirect(route('closureCimlets.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW(): array
    {
        return [" "] + closureCimlets::orderBy('name')->pluck('name', 'id')->toArray();
    }

    /*
     * ClosureCimlets értékek módosítás
     *
     * @param $request
     *
     * @return ClosureCimlets
     */
    public function closureCimletsUpdate(Request $request): Response
    {

        ClosureCimlets::find($request->get('id'))->update(['value' => $request->get('value'),
            'updated_at' => \Carbon\Carbon::now()]);

        return Response::json(ClosureCimlets::find($request->get('id')));

    }

    public function closureCimletsSum(Request $request): object
    {

        return ClosureCimlets::closureclosurecimlets($request->get('id'))->get()->sum('cash');

    }
}



