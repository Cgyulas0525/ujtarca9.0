<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\Models\Location;
use App\Models\Partners;
use DB;

use App\Enums\ActiveEnum;
use Alert;
use Illuminate\Support\Facades\Config;

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
                $btn = '<a href="' . route('locationPartnersDestroy', [$row->pivot->location_id, $row->pivot->partners_id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->make(true);
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

    public function create($location)
    {
        return view('locations.partners.create')->with(['location' => Location::find($location)]);
    }

    public function store(Request $request)
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
        return view('locations.partners.create')->with(['location' => $location]);
    }

    public function destroy($location, $partner)
    {
        Alert::question('Biztos törli a tételt?')
            ->showCancelButton('<a href="' . route('locations.edit', ['location' => $location]) . '" style="color:white;">' . 'Kilép' . '</a>',
                'red')
            ->showConfirmButton(
                '<a href="' . route('locationPartnersDestroyRecord', [$location, $partner]) . '" style="color:white;">' . 'Töröl' . '</a>',
                'gray',
            )->autoClose(false);
        return view(Config::get('LAYOUTS_SHOW'))->with('table', Location::find($location)->partners()->where('partners_id', $partner)->first());
    }

    public function destroyRecord($location, $partner)
    {
        $location = Location::find($location);
        if (empty($location)) {
            return redirect(route('locations.edit', ['location' => $location->id]));
        }
        DB::beginTransaction();
        try {
            $partner = Partners::find($partner);
            $partner->active = ActiveEnum::INACTIVE->value;
            $partner->save();
            $location->partners()->detach($partner->id);
            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

        }
        return redirect(route('locations.edit', ['location' => $location->id]));
    }

}
