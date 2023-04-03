<?php

namespace App\Exports;

use App\Models\Clase;
use App\Models\Horas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClasesviewExport implements  FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('back/horarioexport', [
            'Clase' => Clase::where('h_id',11),
            'dias' => config('global.dias'),
            'colors' => config('global.colors'),
            'horas' => Horas::where('activo','1')
            ->where('num_cal','1')
            ->where('modalidad',2)
            ->orderBy('hora_ini')->get(),
            'hid' => '11',
        ]);
    }
}
