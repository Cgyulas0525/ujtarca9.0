<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;
use Database\Seeders\QuantitiesSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\ComponentSeeder;

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
    protected $description = 'Budget 2.0 database correction';

    public function invoices(): void
    {
        Models\Invoices::where('paymentmethod_id', 2)->each(function ($invoice) {
            $invoice->referred_date = $invoice->deadline;
            $invoice->save();
        });
    }

    public function products(): void
    {
        Models\Products::where('active', 1)->each(function ($item) {
            $item->active = 'inaktív';
            $item->save();
        });
        Models\Products::where('active', "!=",  1)->each(function ($item) {
            $item->active = 'aktív';
            $item->save();
        });
    }

    public function partners(): void
    {
        Models\Partners::where('active', 1)->each(function ($item) {
            $item->active = 'inaktív';
            $item->save();
        });
        Models\Partners::where('aktív', "!=",  1)->each(function ($item) {
            $item->active = 'inaktív';
            $item->save();
        });
    }

    public function partnerTypes(string $type): void
    {
        $partnerTypes = new Models\PartnerTypes();
        $partnerTypes->name = $type;
        $partnerTypes->save();
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

        $this->info('Invoices referred_date!');
        $this->invoices();
        $this->info('Products active!');
        $this->products();
        $this->info('Partners active!');
        $this->partners();
        $this->partnerTypes('WEB vevő');
        $this->partnerTypes('Kiszállítás vevő');
        $this->info('Seeders!');
        $this->call(QuantitiesSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(ComponentSeeder::class);
        $this->info('Method has been executed successfully!');

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
