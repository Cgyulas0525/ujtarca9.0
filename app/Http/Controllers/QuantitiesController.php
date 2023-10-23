<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuantitiesRequest;
use App\Http\Requests\UpdateQuantitiesRequest;
use App\Repositories\QuantitiesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Quantities;

use Illuminate\Http\Request;
use Response;
use Auth;
use DataTables;

class QuantitiesController extends AppBaseController
{
    /** @var QuantitiesRepository $quantitiesRepository*/
    private $quantitiesRepository;

    public function __construct(QuantitiesRepository $quantitiesRepo)
    {
        $this->quantitiesRepository = $quantitiesRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('quantities.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Quantities', $row["id"], 'quantities']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Quantities.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->quantitiesRepository->all();
                return $this->dwData($data);

            }

            return view('quantities.index');
        }
    }

    /**
     * Show the form for creating a new Quantities.
     *
     * @return Response
     */
    public function create()
    {
        return view('quantities.create');
    }

    /**
     * Store a newly created Quantities in storage.
     *
     * @param CreateQuantitiesRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantitiesRequest $request)
    {
        $input = $request->all();

        $quantities = $this->quantitiesRepository->create($input);

        return redirect(route('quantities.index'));
    }

    /**
     * Display the specified Quantities.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quantities = $this->quantitiesRepository->find($id);

        if (empty($quantities)) {
            return redirect(route('quantities.index'));
        }

        return view('quantities.show')->with('quantities', $quantities);
    }

    /**
     * Show the form for editing the specified Quantities.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quantities = $this->quantitiesRepository->find($id);

        if (empty($quantities)) {
            return redirect(route('quantities.index'));
        }

        return view('quantities.edit')->with('quantities', $quantities);
    }

    /**
     * Update the specified Quantities in storage.
     *
     * @param int $id
     * @param UpdateQuantitiesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuantitiesRequest $request)
    {
        $quantities = $this->quantitiesRepository->find($id);

        if (empty($quantities)) {
            return redirect(route('quantities.index'));
        }

        $quantities = $this->quantitiesRepository->update($request->all(), $id);

        return redirect(route('quantities.index'));
    }

    /**
     * Remove the specified Quantities from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quantities = $this->quantitiesRepository->find($id);

        if (empty($quantities)) {
            return redirect(route('quantities.index'));
        }

        $this->quantitiesRepository->delete($id);

        return redirect(route('quantities.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + quantities::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



