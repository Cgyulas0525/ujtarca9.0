<?php

namespace App\Providers;

use App\Classes\DailySum\DailySum;
use App\Classes\DailySum\GetDailySum;
use App\Classes\DailySum\GetPeriodAverageDailySum;
use App\Classes\DailySum\GetPeriodDailySum;
use App\Classes\Reports\MonthInvoicesResultClass;
use App\Classes\Reports\PaymentMethodLast30daysClass;
use App\Classes\Reports\QueryTurnoverClass;
use App\Classes\Reports\TurnoverLastTwoYearsClass;
use App\Classes\Reports\WeekInvoicesResultClass;
use App\Interfaces\DailySum\DailySumInterface;
use App\Interfaces\DailySum\GetDailySumInterface;
use App\Interfaces\DailySum\GetPeriodAverageDailySumInterface;
use App\Interfaces\DailySum\GetPeriodDailySumInterface;
use App\Interfaces\Reports\MonthInvoicesResultInterface;
use App\Interfaces\Reports\PaymentMethodLast30daysInterface;
use App\Interfaces\Reports\QueryTurnoverInterface;
use App\Interfaces\Reports\ReportsInterface;
use App\Interfaces\Reports\TurnoverLastTwoYearsInterface;
use App\Interfaces\Reports\WeekInvoicesResultInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Auth;

use App\Classes\FinanceClass;
use App\Classes\FinancePeriodClass;
use App\Http\Controllers\DashboardController;
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
use App\Enums\ActiveEnum;
use App\Enums\OrderTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Classes\Reports\ReportsClass;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(QueryTurnoverInterface::class, QueryTurnoverClass::class);
        $this->app->bind(WeekInvoicesResultInterface::class, WeekInvoicesResultClass::class);
        $this->app->bind(PaymentMethodLast30daysInterface::class, PaymentMethodLast30daysClass::class);
        $this->app->bind(TurnoverLastTwoYearsInterface::class, TurnoverLastTwoYearsClass::class);
        $this->app->bind(MonthInvoicesResultInterface::class, MonthInvoicesResultClass::class);
        $this->app->bind(ReportsInterface::class, function ($app) {
            return new ReportsClass(
                $app->make(QueryTurnoverInterface::class),
                $app->make(WeekInvoicesResultInterface::class),
                $app->make(PaymentMethodLast30daysInterface::class),
                $app->make(TurnoverLastTwoYearsInterface::class),
                $app->make(MonthInvoicesResultInterface::class)
            );
        });

        $this->app->bind(GetDailySumInterface::class, GetDailySum::class);
        $this->app->bind(GetPeriodDailySumInterface::class, GetPeriodDailySum::class);
        $this->app->bind(GetPeriodAverageDailySumInterface::class, GetPeriodAverageDailySum::class);
        $this->app->bind(DailySumInterface::class, function ($app) {
            return new DailySum(
                $app->make(GetDailySumInterface::class),
                $app->make(GetPeriodAverageDailySumInterface::class),
                $app->make(GetPeriodDailySumInterface::class),
            );
        });
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('FinanceClass', FinanceClass::class);
            $loader->alias('FinancePeriodClass', FinancePeriodClass::class);
            $loader->alias('RiportsClass', RiportsClass::class);
            $loader->alias('ToolsClass', ToolsClass::class);
            $loader->alias('DashboardController', DashboardController::class);
            $loader->alias('OrderService', OrderService::class);
            $loader->alias('MyApiController', MyApiController::class);
            $loader->alias('SelectService', SelectService::class);
            $loader->alias('ActiveEnum', ActiveEnum::class);
            $loader->alias('OrderTypeEnum', OrderTypeEnum::class);
            $loader->alias('OrderStatusEnum', OrderStatusEnum::class);
            session(['invoiceYear' => date('Y')]);
            session(['invoicePartner' => null]);
            session(['invoiceReferred' => 'Yes']);
        });
    }

    public function boot(): void
    {
        Closures::observe(ClosuresObserver::class);
        Invoices::observe(InvoicesObserver::class);
        Orderdetails::observe(OrderdetailsObserver::class);
        Config::set('LAYOUTS_SHOW', 'layouts.show');
        Config::set('OFFER_PREV', 'VMEGR-');
        Config::set('ORDER_PREV', 'SZMEGR-');
    }
}
