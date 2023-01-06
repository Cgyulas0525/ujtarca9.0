<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Repositories\PartnersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Partners;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class PartnersController extends AppBaseController
{
    /** @var PartnersRepository $partnersRepository*/
    private $partnersRepository;

    public function __construct(PartnersRepository $partnersRepo)
    {
        $this->partnersRepository = $partnersRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('partners.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Partners', $row["id"], 'partners']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Partners.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->partnersRepository->all();
                return $this->dwData($data);

            }

            return view('partners.index');
        }
    }

    /**
     * Show the form for creating a new Partners.
     *
     * @return Response
     */
    public function create()
    {
        return view('partners.create');
    }

    /**
     * Store a newly created Partners in storage.
     *
     * @param CreatePartnersRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnersRequest $request)
    {
        $input = $request->all();

        $partners = $this->partnersRepository->create($input);

        return redirect(route('partners.index'));
    }

    /**
     * Display the specified Partners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        return view('partners.show')->with('partners', $partners);
    }

    /**
     * Show the form for editing the specified Partners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        return view('partners.edit')->with('partners', $partners);
    }

    /**
     * Update the specified Partners in storage.
     *
     * @param int $id
     * @param UpdatePartnersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnersRequest $request)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        $partners = $this->partnersRepository->update($request->all(), $id);

        return redirect(route('partners.index'));
    }

    /**
     * Remove the specified Partners from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        $this->partnersRepository->delete($id);

        return redirect(route('partners.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + partners::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



