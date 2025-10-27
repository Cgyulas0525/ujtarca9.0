<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BakedGoodsImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $r = $row->toCollection(); // kulcsok a fejléc alapján

        Products::create([
            'name'   => (string)($r['termek_nev']   ?? ''),
            'quantities_id' => 1,
            'price' => (int)  ($r['ar'] ?? 0),
            'active' => 'aktív',
        ]);
    }
}
