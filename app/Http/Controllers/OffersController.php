<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Repositories\OffersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Offers;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class OffersController extends AppBaseController
{
    /** @var OffersRepository $offersRepository*/
    private $offersRepository;

    public function __construct(OffersRepository $offersRepo)
    {
        $this->offersRepository = $offersRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('offers.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Offers', $row["id"], 'offers']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Offers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->offersRepository->all();
                return $this->dwData($data);

            }

            return view('offers.index');
        }
    }

    /**
     * Show the form for creating a new Offers.
     *
     * @return Response
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created Offers in storage.
     *
     * @param CreateOffersRequest $request
     *
     * @return Response
     */
    public function store(CreateOffersRequest $request)
    {
        $input = $request->all();

        $offers = $this->offersRepository->create($input);

        return redirect(route('offers.index'));
    }

    /**
     * Display the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        return view('offers.show')->with('offers', $offers);
    }

    /**
     * Show the form for editing the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        return view('offers.edit')->with('offers', $offers);
    }

    /**
     * Update the specified Offers in storage.
     *
     * @param int $id
     * @param UpdateOffersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOffersRequest $request)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        $offers = $this->offersRepository->update($request->all(), $id);

        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified Offers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        $this->offersRepository->delete($id);

        return redirect(route('offers.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + offers::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



