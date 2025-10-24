<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\PartnerTypeEnum;
use App\Models\Orderdetails;
use App\Models\Orders;
use App\Models\Partners;
use App\Repositories\OrdersRepository;
use App\Services\GetPartnerType;
use Illuminate\Http\Request;
use Auth;
use DataTables;

use App\Traits\OrderEmailTrait;

class OrdersController extends AppBaseController
{
    /** @var OrdersRepository $ordersRepository */
    private $ordersRepository;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    use OrderEmailTrait;

    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('partnerName', function ($data) {
                return $data->partners->name;
            })
            ->addColumn('deliveryNumber', function ($data) {
                return isset($data->delivery->delivery_number) ? $data->delivery->delivery_number : '';
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('orders.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Orders', $row->id, 'orders']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                $btn = $btn . '<a href="' . route('orderPrint', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Nyomtatás"><i class="fas fa-print"></i></a>';
                $btn = $btn . '<a href="' . route('orderEmail', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Email"><i class="fas fa-envelope-open"></i></a>';
                $btn = $btn . '<a href="' . route('orderReplay', [$row->id]) . '"
                                 class="btn btn-primary btn-sm replayOrder" title="Ismétlés"><i class="fas fa-copy"></i></a>';
                $btn = $btn . '<a href="' . route('editDetails', [$row->id]) . '"
                                 class="btn btn-secondary btn-sm editDetailsí" title="Tételek"><i class="fas fa-bars"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request, ?string $orderType = null, ?string $orderStatus = null): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Orders::with('partners', 'delivery')->ordersByTypeAndStatus($orderType, $orderStatus)->get());
            }
            return view('orders.index');
        }
        return view('orders.index');
    }

    public function create(): object
    {
        return view('orders.create');
    }

    public function store(Request $request): object
    {
        $orders = new Orders();
        $orders->ordernumber = $request->ordernumber;
        $orders->orderdate = $request->orderdate;
        $orders->partners_id = $request->partners_id;
        $orders->description = $request->description;
        $orders->order_status = OrderStatusEnum::ORDERED->value;
        $orders->ordertype = $request->ordertype;
        $orders->delivery_id = $request->delivery_id;
        $orders->detailsum = 0;
        $orders->save();

        return view('orders.edit')->with('orders', $orders);
    }

    public function show($id): object
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        return view('orders.show')->with('orders', $orders);
    }

    public function edit($id): object
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        return view('orders.edit')->with('orders', $orders);
    }

    public function editDetails($id): object
    {
        $orders = Orders::with('partners')->findOrFail($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        return view('orders.edit-with-detail')->with(['orders' => $orders, 'detail' => true]);
    }

    public function update(Request $request): object
    {

        $orders = $this->ordersRepository->find($request->id);
        $orders->ordernumber = $request->ordernumber;
        $orders->orderdate = $request->orderdate;
        $orders->partners_id = $request->partners_id;
        $orders->description = $request->description;
        $orders->delivery_id = $request->delivery_id;
        $orders->ordertype = $request->ordertype;
        $orders->save();

        if (empty($orders)) {
            return redirect(route('orders.index'));
        }

        return redirect(route('orders.index'));
    }

    public function destroy($id): object
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        $this->ordersRepository->delete($id);

        return redirect(route('orders.index'));
    }

    public function print($id): object
    {
        $this->order = Orders::find($id);
        $this->owner = Partners::where('partnertypes_id', GetPartnerType::getPartnerTypesId(PartnerTypeEnum::OWNER->value))->first();
        $this->partner = Partners::find($this->order->partners_id);
        $this->details = Orderdetails::where('orders_id', $this->order->id)->get();

        return view('printing.orderPrint')->with(['order' => $this->order, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);
    }
}
