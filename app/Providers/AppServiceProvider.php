<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Auth;

use App\Classes\FinanceClass;
use App\Classes\FinancePeriodClass;
use App\Http\Controllers\DashboardController;
use App\Classes\OwnClass\ClosuresClass;
use App\Classes\RiportsClass;
use App\Classes\ToolsClass;
use App\Services\OrderService;
use App\Services\SelectService;
use App\Http\Controllers\MyApiController;

use App\Models\Closures;
use App\Observers\ClosuresObserver;
use App\Models\Invoices;
use App\Observers\InvoicesObserver;
use App\Models\Orderdetails;
use App\Observers\OrderdetailsObserver;
use App\Models\Orders;
use App\Observers\OrdersObserver;
use App\Enums\ActiveEnum;
use App\Enums\OrderTypeEnum;
use App\Enums\OrderStatusEnum;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('FinanceClass', FinanceClass::class);
            $loader->alias('FinancePeriodClass', FinancePeriodClass::class);
            $loader->alias('ClosuresClass', ClosuresClass::class);
            $loader->alias('RiportsClass', RiportsClass::class);
            $loader->alias('ToolsClass', ToolsClass::class);
            $loader->alias('DashboardController', DashboardController::class);
            $loader->alias('OrderService', OrderService::class);
            $loader->alias('MyApiController', MyApiController::class);
            $loader->alias('SelectService', SelectService::class);
            $loader->alias('ActiveEnum', ActiveEnum::class);
            $loader->alias('OrderTypeEnum', OrderTypeEnum::class);
            $loader->alias('OrderStatusEnum', OrderStatusEnum::class);
        });
    }

    public function boot(): void
    {
        Closures::observe(ClosuresObserver::class);
        Invoices::observe(InvoicesObserver::class);
        Orderdetails::observe(OrderdetailsObserver::class);
        Orders::observe(OrdersObserver::class);
        Config::set('LAYOUTS_SHOW', 'layouts.show');
        Config::set('OFFER_PREV', 'VMEGR-');
        Config::set('ORDER_PREV', 'SZMEGR-');
    }
}
