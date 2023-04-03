<?php

namespace App\Exports;

use App\Models\Profesor;
use App\Models\Horas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProfesviewExport implements FromView, ShouldAutoSize
{
    public function __construct(int $id, int $periodo_id)
    {
        $this->id = $id;
        $this->periodo_id = $periodo_id;
    }
    public function view(): View
    {
        //dd($this->id , $this->periodo_id);
        return view('back/profesorexport', [
            'profesor' => Profesor::where('id',$this->id)->first(),
            'dias' => config('global.dias'),
            'colors' => config('global.colors'),
            'horas' => Horas::where('activo','1')
            ->where('num_cal','1')
            ->orderBy('dia')
            ->orderBy('hora_ini')->get(),
            'periodo_id' => $this->periodo_id,
        ]);
    }
}
