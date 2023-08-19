<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Winner;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class WinnerController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'winners.created_at';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }

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
                    'visitors.position as position',
                    'visitors.card as card',
                    'winners.created_at as win_created_at',
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
                    'visitors.position as position',
                    'visitors.card as card',
                    'winners.created_at as win_created_at',
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

        $visitor = Attendance::whereDate('created_at', date('Y-m-d'))
                    ->inRandomOrder()
                    ->first();
                    // ->get();

        // echo('<script>console.log("'. var_dump($visitor) .'")</script>');
        $wtmp = Winner::whereDate('created_at', date('Y-m-d'))
                ->where('vis_id', $visitor->vis_id)
                ->get();

        echo("<script>console.log('visitor: ".var_dump($visitor)."')</script>");
        echo("<script>console.log('winner: ".var_dump($wtmp)."')</script>");

        while (isset($wtmp->id)) {
            $visitor = Attendance::whereDate('created_at', date('Y-m-d'))
                    ->groupBy('vis_id')
                    ->inRandomOrder()
                    ->first();

            $wtmp = Winner::where('vis_id', $visitor->vis_id)
                ->whereDate('created_at', date('Y-m-d'))
                ->get();

            echo("<script>console.log('visitor: ".var_dump($visitor)."')</script>");
            echo("<script>console.log('winner: ".var_dump($wtmp)."')</script>");
        }
            //This is suppose to be visitors who has attendance with today's date

        $winner = Winner::create([
            'vis_id' => $visitor->vis_id,
            'desc' => 'toBeFilled',
        ]);

        $winner_full =  DB::table('winners')
                ->where('vis_id', $winner->vis_id)
                ->join('visitors', 'winners.vis_id', '=', 'visitors.id')
                ->select(
                    'winners.id as id',
                    'visitors.conf_id as conf_id',
                    'visitors.name as name',
                    'visitors.email as email',
                    'visitors.phone as phone',
                    'visitors.company as company',
                    'visitors.sex as sex',
                    'visitors.position as position',
                    'visitors.card as card',
                    'winners.created_at as win_created_at',
                    'visitors.created_at as vis_created_at',
                )->first();

        return view('admin.lottery.index')
            ->with('winner', $winner_full)
            ->with('status', [
                'type' => 'success',
                'text' => 'winner created.'
        ]);
    }
}
