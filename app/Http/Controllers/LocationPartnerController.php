<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\Models\Location;
use App\Models\Partners;
use DB;

class LocationPartnerController extends Controller
{
    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('partner', function ($data) {
                return ($data->name);
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('beforeDestroys', ['Location', $row->id, 'locations']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->make(true);
    }

    public function create($location)
    {
        return view('locations.partners.create')->with(['location' => Location::find($location)]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $partner = new Partners();
            $partner->name = $request->name;
            $partner->partnertypes_id = $request->partnertypes_id;
            $partner->postcode = $request->postcode;
            $partner->settlement_id = $request->settlement_id;
            $partner->address = $request->address;
            $partner->email = $request->email;
            $partner->active = $request->active;
            $partner->save();

            $location = Location::find($request->location_id);
            $location->partners()->attach($partner->id);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

        }
//        $location = $this->locationRepository->create($input);
        return view('locations.partners.create')->with(['location' => $request->location_id]);
    }


    public function index(Request $request, $location): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Location::find($location)->partners()->get());
            }
            return view('locations.index');
        }
        return view('locations.index');
    }
}
