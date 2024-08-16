<?php

namespace App\Console\Commands;

use Database\Seeders\ComponentSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\QuantitiesSeeder;
use App\Models;
use Illuminate\Console\Command;


class DatabaseCorrection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DatabaseCorrection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Budget database correction';

    public function invoices()
    {
        Models\Invoices::where('paymentmethod_id', 2)->each(function ($invoice) {
            $invoice->referred_date = $invoice->deadline;
            $invoice->save();
        });
    }

    public function products()
    {
        Models\Products::where('active', 1)->each(function ($product) {
            $product->active = 'aktív';
            $product->save();
        });
    }

    public function partners()
    {
        Models\Partners::where('active', 1)->each(function ($partner) {
            $partner->active = 'aktív';
            $partner->save();
        });
        Models\Partners::where('active', '!=', 1)->each(function ($partner) {
            $partner->active = 'inaktív';
            $partner->save();
        });
    }

    public function partnerTypes(string $type)
    {
        $partnerType = new Models\PartnerTypes();
        $partnerType->name = $type;
        $partnerType->save();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'telescope-migrations'
        ]);
        $this->call('vendor:publish', [
            '--tag' => 'medialibrary-migrations'
        ]);
        $this->call('migrate');
        $this->call(FeatureSeeder::class);
        $this->call(QuantitiesSeeder::class);
        $this->call(ComponentSeeder::class);
        $this->invoices();
        $this->products();
        $this->partners();
        $this->partnerTypes('WEB vevő');
        $this->partnerTypes('Kiszállítás vevő');
        $this->info('DatabaseCorrection command successfully');
        return Command::SUCCESS;
    }
}
