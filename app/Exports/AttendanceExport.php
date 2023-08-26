<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class AttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('attendances')
                ->join('visitors', 'attendances.vis_id', '=', 'visitors.id')
                ->select(
                    'attendances.created_at as Entry_Date',
                    'visitors.conf_id as Customer_ID',
                    'visitors.phone as Customer_Phone',
                    'visitors.created_at as Registered_Date',
                )->get();
    }

    public function headings(): array
    {
        return ['Entry Date', 'Customer_ID', 'Cutomer Phone', 'Registered Date'];
    }
}
