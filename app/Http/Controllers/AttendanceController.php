<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Visitor;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
                    'visitors.name as name',
                    'visitors.email as email',
                    'visitors.phone as phone',
                    'visitors.company as company',
                    'visitors.card as card',
                    'attendances.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )->where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('name', 'LIKE', '%'.$request->searchVal.'%')
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
                    'visitors.name as name',
                    'visitors.email as email',
                    'visitors.phone as phone',
                    'visitors.company as company',
                    'visitors.card as card',
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

        $intr = [
            'pos1' => Interest::where('description','Clothings')->count(),
            'pos2' => Interest::where('description','Fabrics and Accessories')->count(),
            'pos3' => Interest::where('description','Machinery')->count(),
            'pos4' => Interest::where('description','Bags')->count(),
            'pos5' => Interest::where('description','Shoes')->count(),
            'pos6' => Interest::where('description','Others')->count(),
        ];

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
        $Vtoday = Visitor::whereDate('created_at', date('Y-m-d'))
                    ->count();

        return view('admin.index')
            ->with('visitors', $visitors)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('Vtotal', $Vtotal)
            ->with('Vtoday', $Vtoday)
            ->with('intr', $intr)
            ->with('entry', $entry)
            ->with('status', [
                'type' => 'success',
                'text' => 'Attendances view read.'
            ]);
    }

    public function store(Request $request, $id)
    {
        $visitor = Visitor::where('conf_id', 'LIKE', $id)->first();

        if ($visitor == Null) {
            $response = [
                'type' => 'fail',
                'text' => 'Attendance not recorded. Visitor id not found.'
            ];
            return response($response, 404);
        }

        // var_dump($visitor->conf_id);

        $att = Attendance::create([
            'vis_id' => $visitor->id
        ]);

        $response = [
            'type' => 'success',
            'text' => 'Attendance of '.$id.' recorded successfully.'
        ];
        return response($response, 200);
    }
}
