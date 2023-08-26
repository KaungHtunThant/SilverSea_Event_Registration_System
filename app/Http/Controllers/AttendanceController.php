<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Visitor;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'attendances.created_at';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }

        if ($request->searchVal != '') {
            $visitors =  DB::table('attendances')
                ->join('visitors', 'attendances.vis_id', '=', 'visitors.id')
                ->select(
                    'attendances.id as id',
                    'visitors.conf_id as conf_id',
                    'visitors.phone as phone',
                    'attendances.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )->where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
                ->orderBy($request->orderBy, 'DESC')
                ->paginate($request->paginate);
        }
        else{
            $visitors =  DB::table('attendances')
                ->join('visitors', 'attendances.vis_id', '=', 'visitors.id')
                ->select(
                    'attendances.id as id',
                    'visitors.conf_id as conf_id',
                    'visitors.phone as phone',
                    'attendances.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )
                ->orderBy($request->orderBy, 'DESC')
                ->paginate($request->paginate);
        }
        $visitors->appends([
            'orderBy' => $request->orderBy,
            'searchVal' => $request->searchVal,
            'paginate' => $request->paginate
        ]);

        $entry = [
            '9am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 9am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 10am')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '10am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 10am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 11am')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '11am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 11am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 12pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '12pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 12pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 1pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '1pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 1pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 2pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '2pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 2pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 3pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '3pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 3pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 4pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '4pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 4pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 5pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
            '8pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('today 8pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('today 11pm')))
                        ->whereDate('created_at', date('Y-m-d'))
                        ->count(),
        ];
        
        $Vtotal = Visitor::get()->count();
        $Vtoday = Attendance::whereDate('created_at', date('Y-m-d'))
                    // ->groupBy('vis_id')
                    ->count();

        return view('admin.index')
            ->with('visitors', $visitors)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('Vtotal', $Vtotal)
            ->with('Vtoday', $Vtoday)
            ->with('entry', $entry)
            ->with('status', [
                'type' => 'success',
                'text' => 'Attendances view read.'
            ]);
    }

    public function export()
    {
        return Excel::download(new AttendanceExport, 'customers_attendance_'.time().'.xlsx');
    }
}
