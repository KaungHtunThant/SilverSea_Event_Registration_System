<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Winner;

class WinnerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->searchVal != '') {
            $Winners =  Winner::where('vis_id', 'LIKE', '%'.$searchVal.'%')
            // ->orwhere('name', 'LIKE', '%'.$search_value.'%')
            // ->orwhere('phone', 'LIKE', '%'.$search_value.'%')
            ->orderBy($request->orderBy)
            ->paginate($request->paginate);
        }
        else{
            $winners = Winner::orderBy($request->orderBy)->paginate($request->paginate);
        }

        return view('admin.winners.index')
            ->with('winners', $winners)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('status', [
                'type' => 'success',
                'text' => 'Visitor view read.'
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

        return redirect('/winners')->with('status', [
            'type' => 'success',
            'winner' => $visitor
        ]);
    }
}
