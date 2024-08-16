<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

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

    public function invoices()
    {
        Models\Invoices::where('paymentmethod_id', 2)->each(function ($invoice) {
            $invoice->referred_date = $invoice->deadline;
            $invoice->save();
        });
    }

    public function products()
    {
        Models\Products::where('active', 1)->each(function ($item) {
            $item->active = 'aktív';
            $item->save();
        });
        Models\Products::where('active', "!=",  1)->each(function ($item) {
            $item->active = 'inaktív';
            $item->save();
        });
    }

    public function partners()
    {
        Models\Partners::where('active', 1)->each(function ($item) {
            $item->active = 'aktív';
            $item->save();
        });
        Models\Partners::where('active', "!=",  1)->each(function ($item) {
            $item->active = 'inaktív';
            $item->save();
        });
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
        $this->info('Method has been executed successfully!');

        return Command::SUCCESS;
    }
}
