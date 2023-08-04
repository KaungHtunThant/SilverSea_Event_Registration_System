<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Winner;
use Illuminate\Support\Facades\DB;

class WinnerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->searchVal != '') {
            $winners =  DB::table('winners')
                ->join('visitors', 'winners.vis_id', '=', 'visitors.id')
                ->select(
                    'winners.id as id',
                    'visitors.conf_id as conf_id',
                    'visitors.name as name',
                    'visitors.email as email',
                    'visitors.phone as phone',
                    'visitors.company as company',
                    'visitors.sex as sex',
                    'visitors.dob as dob',
                    'visitors.card as card',
                    'winners.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )->where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('name', 'LIKE', '%'.$request->searchVal.'%')
                ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
                ->orderBy($request->orderBy)
                ->paginate($request->paginate);
        }
        else{
            $winners =  DB::table('winners')
                ->join('visitors', 'winners.vis_id', '=', 'visitors.id')
                ->select(
                    'winners.id as id',
                    'visitors.conf_id as conf_id',
                    'visitors.name as name',
                    'visitors.email as email',
                    'visitors.phone as phone',
                    'visitors.company as company',
                    'visitors.sex as sex',
                    'visitors.dob as dob',
                    'visitors.card as card',
                    'winners.created_at as att_created_at',
                    'visitors.created_at as vis_created_at',
                )->paginate($request->paginate);
        }
        $winners->appends([
            'orderBy' => $request->orderBy,
            'searchVal' => $request->searchVal,
            'paginate' => $request->paginate
        ]);

        return view('admin.winners.index')
            ->with('winners', $winners)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('status', [
                'type' => 'success',
                'text' => 'winners view read.'
            ]);
    }

    public function rng(Request $request)
    {
        // $visitors = Visitor::factory()->count(10)->create(); //delete me after testing

        $visitor = Visitor::all()->random();    //This is suppose to be visitors who has attendance with today's date

        $winner = Winner::create([
            'vis_id' => $visitor->id,
            'desc' => 'toBeFilled',
        ]);

        return redirect('/test')->with('status', [
            'type' => 'success',
            'winner' => $visitor
        ]);
    }
}
