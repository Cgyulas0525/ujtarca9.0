<?php

namespace App\Observers;

use App\Models\Orderdetails;
use App\Services\OrderService;
use App\Models\Products;
use App\Services\ProductsService;

class OrderdetailsObserver
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductsService();
    }
    /**
     * Handle the Orderdetails "updating" event.
     *
     * @param Orderdetails $orderdetails
     * @return void
     */
    public function creating(OrderDetails $orderdetails): void
    {
        $orderdetails->detailvalue = $orderdetails->value * $this->productService->getProductPriceByOrderType($orderdetails);
    }

    /**
     * Handle the Orderdetails "created" event.
     *
     * @param \App\Models\Orderdetails $orderdetails
     * @return void
     */
    public function created(Orderdetails $orderdetails): void
    {
        OrderService::setOrderDetailsum($orderdetails);
    }

    /**
     * Handle the Orderdetails "updating" event.
     *
     * @param Orderdetails $orderdetails
     * @return void
     */
    public function updating(OrderDetails $orderdetails): void
    {
        $orderdetails->detailvalue = $orderdetails->value * $this->productService->getProductPriceByOrderType($orderdetails);
    }

    /**
     * Handle the Orderdetails "updated" event.
     *
     * @param \App\Models\Orderdetails $orderdetails
     * @return void
     */
    public function updated(Orderdetails $orderdetails): void
    {
        OrderService::setOrderDetailsum($orderdetails);
    }

    /**
     * Handle the Orderdetails "deleted" event.
     *
     * @param \App\Models\Orderdetails $orderdetails
     * @return void
     */
    public function deleted(Orderdetails $orderdetails): void
    {
        OrderService::setOrderDetailsum($orderdetails);
    }
}
