<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->searchVal != '') {
            $visitors =  DB::table('attendances')
                ->join('visitors', 'attendances.vis_id', '=', 'visitors.id')
                ->select(
                    'attendances.id',
                    'visitors.conf_id',
                    'visitors.name',
                    'visitors.email',
                    'visitors.phone',
                    'visitors.company',
                    'visitors.sex',
                    'visitors.dob',
                    'visitors.card'
                )->where('conf_id', 'LIKE', '%'.$searchVal.'%')
                ->orwhere('name', 'LIKE', '%'.$searchVal.'%')
                ->orwhere('phone', 'LIKE', '%'.$searchVal.'%')
                ->orderBy($request->orderBy)
                ->paginate($request->paginate);
        }
        else{
            $visitors =  DB::table('attendances')
                ->join('visitors', 'attendances.vis_id', '=', 'visitors.id')
                ->select(
                    'attendances.id',
                    'visitors.conf_id',
                    'visitors.name',
                    'visitors.email',
                    'visitors.phone',
                    'visitors.company',
                    'visitors.sex',
                    'visitors.dob',
                    'visitors.card'
                )->paginate($request->paginate);
        }

        return view('admin.index')
            ->with('visitors', $visitors)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
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
