<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Models\Delivery;
use App\Repositories\DeliveryRepository;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class DeliveryController extends AppBaseController
{
    /** @var DeliveryRepository $deliveryRepository*/
    private $deliveryRepository;

    public function __construct(DeliveryRepository $deliveryRepo)
    {
        $this->deliveryRepository = $deliveryRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('location', function ($data) {
                return $data->location->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('deliveries.edit', $row->id) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Delivery', $row->id, 'deliveries']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the Delivery.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = Delivery::with('location')->get();
                return $this->dwData($data);
            }
            return view('deliveries.index');
        }
        return view('deliveries.index');
    }

    /**
     * Show the form for creating a new Delivery.
     */
    public function create()
    {
        return view('deliveries.create');
    }

    /**
     * Store a newly created Delivery in storage.
     */
    public function store(CreateDeliveryRequest $request)
    {
        $input = $request->all();

        $delivery = $this->deliveryRepository->create($input);

        Flash::success('Delivery saved successfully.');

        return redirect(route('deliveries.index'));
    }

    /**
     * Display the specified Delivery.
     */
    public function show($id)
    {
        $delivery = $this->deliveryRepository->find($id);

        if (empty($delivery)) {
            Flash::error('Delivery not found');

            return redirect(route('deliveries.index'));
        }

        return view('deliveries.show')->with('delivery', $delivery);
    }

    /**
     * Show the form for editing the specified Delivery.
     */
    public function edit($id)
    {
        $delivery = $this->deliveryRepository->find($id);

        if (empty($delivery)) {
            Flash::error('Delivery not found');

            return redirect(route('deliveries.index'));
        }

        return view('deliveries.edit')->with('delivery', $delivery);
    }

    /**
     * Update the specified Delivery in storage.
     */
    public function update($id, UpdateDeliveryRequest $request)
    {
        $delivery = $this->deliveryRepository->find($id);

        if (empty($delivery)) {
            Flash::error('Delivery not found');

            return redirect(route('deliveries.index'));
        }

        $delivery = $this->deliveryRepository->update($request->all(), $id);

        Flash::success('Delivery updated successfully.');

        return redirect(route('deliveries.index'));
    }

    /**
     * Remove the specified Delivery from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $delivery = $this->deliveryRepository->find($id);

        if (empty($delivery)) {
            Flash::error('Delivery not found');

            return redirect(route('deliveries.index'));
        }

        $this->deliveryRepository->delete($id);

        Flash::success('Delivery deleted successfully.');

        return redirect(route('deliveries.index'));
    }
}
