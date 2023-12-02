<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use Flash;

class LocationController extends AppBaseController
{
    /** @var LocationRepository $locationRepository */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepo)
    {
        $this->locationRepository = $locationRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('pc', function ($data) {
                return $data->settlement->postcode;
            })
            ->addColumn('settlement', function ($data) {
                return $data->settlement->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('locations.edit', $row->id) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Location', $row->id, 'locations']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the Location.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = Location::with('settlement')->get();
                return $this->dwData($data);
            }
            return view('locations.index');
        }
        return view('locations.index');
    }

    /**
     * Show the form for creating a new Location.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created Location in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:locations,name',
        ]);

        if ($validator->fails()) {
            Flash::error('Van már ilyen nevű tétel!')->important();
            return view('locations.create');
        }

        $input = $request->all();
        $location = $this->locationRepository->create($input);
        return redirect(route('locations.index'));
    }

    /**
     * Display the specified Location.
     */
    public function show($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            return redirect(route('locations.index'));
        }

        return view('locations.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified Location.
     */
    public function edit($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            return redirect(route('locations.index'));
        }

        return view('locations.edit')->with('location', $location);
    }

    /**
     * Update the specified Location in storage.
     */
    public function update($id, UpdateLocationRequest $request)
    {
        $location = $this->locationRepository->find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:locations,name,'.$id,
        ]);

        if ($validator->fails()) {
            Flash::error('Van már ilyen nevű tétel!')->important();
            return view('locations.edit')->with('location', $location);
        }

        if (empty($location)) {
            return redirect(route('locations.index'));
        }

        $location = $this->locationRepository->update($request->all(), $id);
        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified Location from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            return redirect(route('locations.index'));
        }

        $this->locationRepository->delete($id);
        return redirect(route('locations.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + Location::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function addLocation(Request $request)
    {
        $location = new Location();
        $location->name = $request->input('name');
        $location->postcode = $request->input('postcode');
        $location->settlement_id = $request->input('settlement_id');
        $location->address = $request->input('address');
        $location->save();
        $locations = Location::all();
        return response()->json(['message' => 'Cím hozzáadva', 'locations' => $locations, 'location' => $location]);
    }

    public function getLocationByName(Request $request)
    {
        $location = Location::where('name', $request->get('name'))->first();
        if (!empty($location)) {
            return Response::json($location->id);
        }
        return Response::json(null);
    }
}
