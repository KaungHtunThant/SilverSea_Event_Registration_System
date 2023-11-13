<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Visitor;
use App\Models\Interest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class VisitorsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $results = DB::table('attendances')
                    ->select(
                        'conf_id',
                        'name', 
                        'email', 
                        'phone', 
                        'company', 
                        'visitors.created_at',
                        DB::raw('group_concat(interests.description separator ", ")')
                    )
                    ->join('interests', 'interests.vis_id', '=', 'attendances.vis_id')
                    ->join('visitors', 'visitors.id', '=', 'attendances.vis_id')
                    ->groupBy('visitors.id')
                    ->orderBy('visitors.id')
                    ->get();
        return $results;
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Phone', 'Email', 'Company', 'Registered Date', 'interests'];
    }
}