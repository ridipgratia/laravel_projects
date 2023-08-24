<?php

namespace App\Exports;

use App\Models\Employe;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportModify implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employe::where('e_id', 15)->get(['e_id', 'login_time']);
    }
    public function view(): View
    {
        return view('exports.student-export', [
            'students' => Employe::all()
        ]);
    }
}
