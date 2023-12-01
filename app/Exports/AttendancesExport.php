<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Visitor;
use App\Models\Interest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class AttendancesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        if ($this->date == '1900-01-01' || $this->date == 'None') {
            $this->date = '1900-01-01';
            $opp = '!=';
        }
        else{
            $opp = '=';
        }

        $interests = DB::table('interests')
                        ->select(
                            DB::raw('group_concat(description separator ", ") as interests'),
                            'vis_id',
                        )
                        ->groupBy('vis_id');

        $visitors = DB::table('visitors')
                        ->select(
                            'id',
                            'conf_id',
                            'name',
                            'email',
                            'phone',
                            'company',
                            'created_at'
                        );

        $results = DB::table('attendances')
                    ->joinSub($interests, 'inter', function ($join){
                        $join->on('attendances.vis_id', '=', 'inter.vis_id');
                    })
                    ->joinSub($visitors, 'vis', function ($join){
                        $join->on('attendances.vis_id', '=', 'vis.id');
                    })
                    ->select(
                        DB::raw('DISTINCT attendances.vis_id'),
                        'vis.conf_id as conf_id',
                        'vis.name as name',
                        'vis.email as email',
                        'vis.phone as phone',
                        'vis.company as company',
                        'vis.created_at as registered_date',
                        'attendances.created_at as enry_date',
                        'inter.interests as interests'
                    )
                    ->whereDate('attendances.created_at', $opp, $this->date)
                    ->groupBy('attendances.id')
                    ->get();

        return $results;
    }

    public function headings(): array
    {
        return ['ID', 'Visitor ID', 'Name', 'Email', 'Phone', 'Company', 'Registered Date', 'Entry Date', 'interests'];
    }
}