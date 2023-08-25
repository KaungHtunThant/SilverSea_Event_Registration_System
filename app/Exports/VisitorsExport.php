<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VisitorsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Confirmation ID',
            'Name',
            'Email',
            'Phone',
            'Company',
            'Sex',
            'Position',
            'created_at'
        ];
    }

    public function collection()
    {
        return Visitor::select('conf_id', 'name', 'email', 'phone', 'company', 'sex', 'position', 'created_at')->get();
    }
}
