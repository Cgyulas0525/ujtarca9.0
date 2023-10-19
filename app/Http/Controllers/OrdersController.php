<?php

namespace App\Http\Controllers;

use App\Classes\OrderClass;
use App\Classes\RedisClass;
use App\Enums\OrderTypeEnum;
use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Orderdetails;
use App\Models\Orders;
use App\Models\Partners;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use Auth;
use DataTables;

use App\Traits\OrderEmailTrait;
use Illuminate\Support\Facades\Redis;

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
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request, ?string $orderType = null): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = $this->getRedis($orderType);
                if (empty($data)) {
                    $this->setRedis($orderType);
                    $data = $this->getRedis($orderType);
                }
                return $this->dwData(json_decode($data));
            }
            return view('orders.index');
        }
        return view('orders.index');
    }

    public function getRedis(?string $orderType = null): mixed
    {
        if (is_null($orderType)) {
            return Redis::get('orders_all');
        } else {
            if ($orderType == OrderTypeEnum::CUSTOMER->value) {
                return Redis::get('orders_customer');
            } else {
                return Redis::get('orders_supplier');
            }
        }
    }

    public function setRedis(?string $orderType = null): void
    {
        if (is_null($orderType)) {
            Redis::setex('orders_all', 3600,  $data = Orders::with('partners')->get());
        } else {
            if ($orderType == OrderTypeEnum::CUSTOMER->value) {
                Redis::setex('orders_customer', 3600, Orders::with('partners')->customerOrders()->get());
            } else {
                Redis::setex('orders_supplier', 3600, Orders::with('partners')->supplierOrders()->get());
            }
        }
    }

    public function create(): object
    {
        return view('orders.create');
    }

    public function store(CreateOrdersRequest $request): object
    {
        $input = $request->all();
        $orders = $this->ordersRepository->create($input);
        RedisClass::setexOrders();

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

    public function update($id, UpdateOrdersRequest $request): object
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        $orders = $this->ordersRepository->update($request->all(), $id);
        RedisClass::setexOrders();

        return redirect(route('orders.index'));
    }

    public function destroy($id): object
    {
        $orders = $this->ordersRepository->find($id);
        if (empty($orders)) {
            return redirect(route('orders.index'));
        }
        $this->ordersRepository->delete($id);
        RedisClass::setexOrders();

        return redirect(route('orders.index'));
    }

    public function print($id): object
    {
        $this->order = Orders::find($id);
        $this->owner = Partners::where('partnertypes_id', 5)->first();
        $this->partner = Partners::find($this->order->partners_id);
        $this->details = Orderdetails::where('orders_id', $this->order->id)->get();

        return view('printing.orderPrint')->with(['order' => $this->order, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);
    }
}
