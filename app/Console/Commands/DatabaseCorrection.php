<?php

namespace App\Console\Commands;

<<<<<<< HEAD
use Illuminate\Console\Command;
use App\Models;
use Database\Seeders\QuantitiesSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\ComponentSeeder;
=======
use Database\Seeders\ComponentSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\QuantitiesSeeder;
use App\Models;
use Illuminate\Console\Command;

>>>>>>> 1024a60851985dc1bba5feac5f3d2c261e735e52

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
<<<<<<< HEAD
    protected $description = 'Budget 2.0 database correction';

    public function invoices(): void
=======
    protected $description = 'Budget database correction';

    public function invoices()
>>>>>>> 1024a60851985dc1bba5feac5f3d2c261e735e52
    {
        Models\Invoices::where('paymentmethod_id', 2)->each(function ($invoice) {
            $invoice->referred_date = $invoice->deadline;
            $invoice->save();
        });
    }

<<<<<<< HEAD
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
=======
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
>>>>>>> 1024a60851985dc1bba5feac5f3d2c261e735e52
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
<<<<<<< HEAD

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

=======
        $this->call(FeatureSeeder::class);
        $this->call(QuantitiesSeeder::class);
        $this->call(ComponentSeeder::class);
        $this->invoices();
        $this->products();
        $this->partners();
        $this->partnerTypes('WEB vevő');
        $this->partnerTypes('Kiszállítás vevő');
        $this->info('DatabaseCorrection command successfully');
>>>>>>> 1024a60851985dc1bba5feac5f3d2c261e735e52
        return Command::SUCCESS;
    }
}
