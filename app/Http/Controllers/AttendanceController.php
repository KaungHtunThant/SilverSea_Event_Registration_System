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
                    'visitors.sex as sex',
                    'visitors.position as position',
                    'visitors.card as card',
                    'attendances.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )->where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('name', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
                ->whereDate('visitors.created_at', date('Y-m-d', strtotime('2024-03-30')))
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
                    'visitors.sex as sex',
                    'visitors.position as position',
                    'visitors.card as card',
                    'attendances.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )
                ->whereDate('visitors.created_at', date('Y-m-d', strtotime('2024-03-30')))
                ->orderBy($request->orderBy, 'DESC')
                ->paginate($request->paginate);
        }
        $visitors->appends([
            'orderBy' => $request->orderBy,
            'searchVal' => $request->searchVal,
            'paginate' => $request->paginate
        ]);

        $intr = [
            'rep' => Interest::where('desc','Real Estate and Properties')->whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))->count(),
            'cons' => Interest::where('desc','Constructions')->whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))->count(),
            'ev' => Interest::where('desc','Renewable Energy and EV')->whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))->count()
        ];

        $entry = [
            '9am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 9am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 10am')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '10am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 10am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 11am')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '11am' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 11am')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 12pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '12pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 12pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 1pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '1pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 1pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 2pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '2pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 2pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 3pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '3pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 3pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 4pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '4pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 4pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 5pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))
                        ->count(),
            '8pm' => Visitor::whereTime('created_at', '>',date('Y-m-d H:i:s', strtotime('2024-03-30 5pm')))
                        ->whereTime('created_at', '<',date('Y-m-d H:i:s', strtotime('2024-03-30 8pm')))
                        ->whereDate('created_at', date('Y-m-d', strtotime('30 March 2024')))    
                        ->count(),
        ];
        
        // $Vtotal = Visitor::get()->count();
        // $Vtotal = Visitor::whereDate('created_at', '>',date('Y-m-d', strtotime('2024-03-28')))
        //             ->whereDate('created_at', '<',date('Y-m-d', strtotime('2024-04-1')))
        //             ->count();
        $Vtotal = Visitor::whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))
                    ->count();
        $Vtoday = Visitor::whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))
                    ->count();

        $Mtotal = Visitor::where('sex','Male')->whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))->count();
        $Ftotal = Visitor::where('sex','Female')->whereDate('created_at', date('Y-m-d', strtotime('2024-03-30')))->count();

        return view('admin.index')
            ->with('visitors', $visitors)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('Vtotal', $Vtotal)
            ->with('Vtoday', $Vtoday)
            ->with('Mtotal', $Mtotal)
            ->with('Ftotal', $Ftotal)
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
        return redirect('/');
    }
}
