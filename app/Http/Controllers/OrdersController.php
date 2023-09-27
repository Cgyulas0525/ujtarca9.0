<?php

namespace App\Http\Controllers;

use App\Classes\OrderClass;
use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Orderdetails;
use App\Models\Orders;
use App\Models\Partners;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use Flash;

use Auth;
use DB;
use DataTables;

use App\Traits\OrderEmailTrait;

class OrdersController extends AppBaseController
{
    /** @var OrdersRepository $ordersRepository */
    private $ordersRepository;
    private $order;
    private $owner;
    private $partner;
    private $details;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    use OrderEmailTrait;

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sumPrice', function ($data) {
                return OrderClass::sumOrderSupplierPrice($data->id);
            })
            ->addColumn('partnerName', function ($data) {
                return $data->partners->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('orders.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Offers', $row->id, 'orders']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                $btn = $btn . '<a href="' . route('offerPrint', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Nyomtatás"><i class="fas fa-print"></i></a>';
                $btn = $btn . '<a href="' . route('offerEmail', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Email"><i class="fas fa-envelope-open"></i></a>';
                $btn = $btn . '<a href="' . route('offerReplay', [$row->id]) . '"
                                 class="btn btn-primary btn-sm deleteProduct" title="Ismétlés"><i class="fas fa-copy"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                Orders::with('partners')->get();
                return $this->dwData(Orders::with('partners')->get());
            }
            return view('orders.index');
        }
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(CreateOrdersRequest $request)
    {
        $input = $request->all();
        $orders = $this->ordersRepository->create($input);
        return redirect(route('orders.index'));
    }

    public function show($id)
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        return view('orders.show')->with('orders', $orders);
    }

    public function edit($id)
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        return view('orders.edit')->with('orders', $orders);
    }

    public function update($id, UpdateOrdersRequest $request)
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        $orders = $this->ordersRepository->update($request->all(), $id);
        return redirect(route('orders.index'));
    }

    public function destroy($id)
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        $this->ordersRepository->delete($id);
        return redirect(route('orders.index'));
    }

    public function print($id)
    {
        $this->order = Orders::find($id);
        $this->owner = Partners::where('partnertypes_id', 5)->first();
        $this->partner = Partners::find($this->order->partners_id);
//        $this->details = Orderdetails::where('orders_id', $this->order->id)->get();

        return view('printing.orderPrint')->with(['order' => $this->order, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);
    }

}
