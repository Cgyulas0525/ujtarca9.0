<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\BakedGoodsImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BakerGoodsImportCommand extends Command
{
    protected $signature = 'command:BakerGoodsImportCommand';

    protected $description = 'Baker goods import from Excel';

    public function handle()
    {
        $relativePath = 'imports/pékáru.xlsx';

        if (!Storage::disk('public')->exists($relativePath)) {
            return response()->json(['message' => "Nem található: public/{$relativePath}"], 404);
        }

        $fullPath = Storage::disk('public')->path($relativePath);

        Excel::import(new BakedGoodsImport, $fullPath);

        $this->info('Method has been executed successfully!');

        return Command::SUCCESS;
    }

}
