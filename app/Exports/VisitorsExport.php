<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VisitorsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visitor::select('conf_id', 'name', 'phone', 'email', 'company','created_at')->orderBy('conf_id')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Phone', 'Email', 'Company', 'Registered Date'];
    }
}
