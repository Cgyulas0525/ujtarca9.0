<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\Partners;
use App\Models\PartnerTypes;
use App\Models\Products;
use App\Models\Delivery;

class SelectService
{
    public static function orderDetailsProductsSelect($id): array
    {
        return [" "] + Products::activeProducts()
                ->whereNotIn('id', function ($query) use ($id) {
                    return $query->from('orderdetails')->select('orderdetails.products_id')->where('orderdetails.orders_id', $id)->get();
                })->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function selectSupplier(): array
    {
        return [" "] + Partners::activePartner()->whereIn('partnertypes_id', [1, 2, 4, 6, 7, 8])
                ->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function selectCustomer(): array
    {
        return [" "] + Partners::activePartner()->whereIn('partnertypes_id', [3, 9, 10])
                ->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function invoicesYearsSelect(): array
    {
        return [" "] + Invoices::selectRaw('year(invoices.dated) as year')->groupBy('year')
                ->orderByDesc('year')
                ->pluck('year', 'year')->toArray();
    }

    public static function selectPartnersByCookie(): array
    {
        return ($_COOKIE['orderType'] == 'CUSTOMER') ? self::selectCustomer() : self::selectSupplier();
    }

    public static function selectDelivery()
    {
        return [" "] + (Delivery::activeDeliveries()->orderBy('delivery_number')->get())->pluck('deliveryFullName', 'id')->toArray();
    }

    public static function selectSupplierTypes(): array
    {
        return [" "] + PartnerTypes::whereIn('id', [1, 2, 4, 6, 7, 8])
                ->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function selectCustomerTypes(): array
    {
        return [" "] + PartnerTypes::whereIn('id', [3, 9, 10])
                ->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function selectPartnerTypesByCookie(): array
    {
        return ($_COOKIE['orderType'] == 'CUSTOMER') ? self::selectCustomerTypes() : self::selectSupplierTypes();
    }

    public static function partnerSupplier()
    {
        return Partners::activePartner()->whereIn('partnertypes_id', [1, 2, 4, 6, 7, 8])->get();
    }

    public static function partnerCustomer()
    {
        return Partners::activePartner()->whereIn('partnertypes_id', [3, 9, 10])->get();
    }

    public static function partnersByCookie()
    {
        return ($_COOKIE['orderType'] == 'CUSTOMER') ? self::partnerCustomer() : self::partnerSupplier();
    }

}
