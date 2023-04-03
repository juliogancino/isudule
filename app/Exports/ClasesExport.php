<?php

namespace App\Exports;

use App\Models\Clase;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class ClasesExport implements FromQuery, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $h_id)
    {
        $this->h_id = $h_id;
    }

    public function query()
    {
        return Clase::query()->where('h_id',$this->h_id);
    }

    
}
