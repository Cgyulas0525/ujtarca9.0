<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FeatureRepository;
use Illuminate\Http\Request;

use Response;
use Flash;
use Auth;
use DataTables;


class FeatureController extends AppBaseController
{
    /** @var FeatureRepository $featureRepository*/
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepository = $featureRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('media', function ($data) {
                return !Empty($data->getFirstMediaUrl($data->getTable() . $data->id)) ? $data->getFirstMediaUrl($data->getTable() . $data->id) : 'img/noAviableImage.jpg';
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('features.edit', $row->id) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Feature', $row->id, 'features']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the Feature.
     */
    public function index(Request $request)
    {
        if( Auth::check() ){
            if ($request->ajax()) {
                $data = $this->featureRepository->all();
                return $this->dwData($data);
            }
            return view('features.index');
        }
        return view('features.index');
    }

    /**
     * Show the form for creating a new Feature.
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created Feature in storage.
     */
    public function store(CreateFeatureRequest $request)
    {
        $input = $request->all();
        $feature = $this->featureRepository->create($input);
        $file = $request->file('file');
        if (!empty($file)){
            $feature->addMedia($file)->toMediaCollection($feature->getTable() . $feature->id, 'media');
        }
        Flash::success('Jellemző mentés sikeres megtörtént.');
        return redirect(route('features.index'));
    }

    /**
     * Display the specified Feature.
     */
    public function show($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        return view('features.show')->with('feature', $feature);
    }

    /**
     * Show the form for editing the specified Feature.
     */
    public function edit($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        return view('features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified Feature in storage.
     */
    public function update(int $id, UpdateFeatureRequest $request)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        $feature = $this->featureRepository->update($request->all(), $id);
        $file = $request->file('file');
        if (!empty($file)){
            $feature->clearMediaCollection($feature->getTable() . $feature->id, 'media');
            $feature->addMedia($file)->toMediaCollection($feature->getTable() . $feature->id, 'media');
        }

        Flash::success('Jellemző módosítás sikeres megtörtént.');

        return redirect(route('features.index'));
    }

    /**
     * Remove the specified Feature from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        $this->featureRepository->delete($id);

        Flash::success('Feature deleted successfully.');

        return redirect(route('features.index'));
    }
}
