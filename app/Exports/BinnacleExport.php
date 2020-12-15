<?php

namespace App\Exports;

use App\Models\Binnacle;
use Maatwebsite\Excel\Concerns\FromCollection;

class BinnacleExport implements FromCollection
{
    public function collection()
    {
        return Binnacle::all();
    }
}
