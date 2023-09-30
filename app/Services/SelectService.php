<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\Partners;
use App\Models\Products;
use App\Enums\ActiveEnum;
use Spatie\LaravelOptions\Options;

class SelectService
{
    public static function offerDetailsProductsSelect($id): array
    {
        return [" "] + Products::activeProducts()
                ->whereNotIn('id', function ($query) use ($id) {
                    return $query->from('offerdetails')->select('offerdetails.products_id')->where('offerdetails.offers_id', $id)->get();
                })->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function orderDetailsProductsSelect($id): array
    {
        return [" "] + Products::activeProducts()
                ->whereNotIn('id', function ($query) use ($id) {
                    return $query->from('orderdetails')->select('orderdetails.products_id')->where('orderdetails.offers_id', $id)->get();
                })->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function selectSuplier(): array
    {
        return [" "] + Partners::activePartner()->whereIn('partnertypes_id', [1, 2, 4, 6, 7, 8])
                ->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function invoicesYearsSelect()
    {
        return [" "] + Invoices::selectRaw('year(invoices.dated) as year')->groupBy('year')
                ->orderBy('year', 'desc')
                ->pluck('year', 'year')->toArray();
    }

    public static function activeEnumsSelect(): mixed
    {
        return Options::forEnum(ActiveEnum::class)->toArray();
    }
}
