<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ComponentRepository;
use Illuminate\Http\Request;
use Flash;

use Auth;
use DataTables;

class ComponentController extends AppBaseController
{
    /** @var ComponentRepository $componentRepository*/
    private $componentRepository;

    public function __construct(ComponentRepository $componentRepo)
    {
        $this->componentRepository = $componentRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('components.edit', $row->id) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Component', $row->id, 'components']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the Component.
     */
    public function index(Request $request)
    {
        if( Auth::check() ){
            if ($request->ajax()) {
                $data = $this->componentRepository->all();
                return $this->dwData($data);
            }
            return view('components.index');
        }
        return view('components.index');
    }

    /**
     * Show the form for creating a new Component.
     */
    public function create()
    {
        return view('components.create');
    }

    /**
     * Store a newly created Component in storage.
     */
    public function store(CreateComponentRequest $request)
    {
        $input = $request->all();

        $component = $this->componentRepository->create($input);

        Flash::success('Component saved successfully.');

        return redirect(route('components.index'));
    }

    /**
     * Display the specified Component.
     */
    public function show($id)
    {
        $component = $this->componentRepository->find($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        return view('components.show')->with('component', $component);
    }

    /**
     * Show the form for editing the specified Component.
     */
    public function edit($id)
    {
        $component = $this->componentRepository->find($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        return view('components.edit')->with('component', $component);
    }

    /**
     * Update the specified Component in storage.
     */
    public function update($id, UpdateComponentRequest $request)
    {
        $component = $this->componentRepository->find($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        $component = $this->componentRepository->update($request->all(), $id);

        Flash::success('Component updated successfully.');

        return redirect(route('components.index'));
    }

    /**
     * Remove the specified Component from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $component = $this->componentRepository->find($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        $this->componentRepository->delete($id);

        Flash::success('Component deleted successfully.');

        return redirect(route('components.index'));
    }
}
