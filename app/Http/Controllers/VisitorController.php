<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Image;
use App\Models\Attendance;
use App\Exports\VisitorsExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'created_at';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }

        if ($request->searchVal != '') {
            $visitors =  Visitor::where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
            ->orderBy($request->orderBy, 'DESC')
            ->paginate($request->paginate);
        }
        else{
            $visitors = Visitor::orderBy($request->orderBy, 'DESC')->paginate($request->paginate);
        }
        $visitors->appends([
            'orderBy' => $request->orderBy,
            'searchVal' => $request->searchVal,
            'paginate' => $request->paginate
        ]);

        return view('admin.visitors.index')
            ->with('visitors', $visitors)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('status', [
                'type' => 'success',
                'text' => 'Visitor view read.'
            ]);
    }

    public function store(Request $request)
    {
        if (Visitor::get()->count() > 160) {
            Session::put('status', 'true');
            return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'failed',
                'text' => 'Customer limit full! Please contact customer service to extend your limit.'
            ]);
        }
        $fields = $request->validate([
            'conf_id' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user = Visitor::create([
            'conf_id' => $fields['conf_id'],
            'phone' => $fields['phone'],
        ]);

        return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'success',
                'text' => 'Visitor record created successfully!'
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'conf_id';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }
        if (!isset($request->searchVal)) {
            $request->searchVal = '';
        }

        $visitor = Visitor::find($id);

        if ($visitor == Null) {
            return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record update failed! Visitor not found.'
            ]);
        }

        $input = $request->all();
        $visitor->fill($input)->save();

        return redirect('/visitors/'.$id)->with('status', [
            'type' => 'success',
            'text' => 'Visitor record updated successfully!'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if ($visitor == Null) {
            return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record deletion failed! Visitor not found.'
            ]);
        }
        
        $visitor->delete();
        return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
            'type' => 'success',
            'text' => 'Visitor record deleted successfully!'
        ]);
    }

    public function show(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if ($visitor == Null) {
            return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record deletion failed! Visitor not found.'
            ]);
        }
        return view('admin.visitors.update')
            ->with('visitor', $visitor)
            ->with('status', [
                'type' => 'success',
                'text' => 'Visitor Details read.'
            ]
        );
    }

    public function id(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if ($visitor == Null) {
            return view('public.visitor_notfound');
        }

        $att = Attendance::create([
            'vis_id' => $id
        ]);

        Session::put('status', 'true');

        return view('admin.visitors.update')
            ->with('visitor', $visitor)
            ->with('status', [
                'type' => 'success',
                'text' => 'Attendance recorded successfully.'
            ]
        );
    }

    public function export()
    {
        return Excel::download(new VisitorsExport, 'visitors_'.time().'.xlsx');
    }
}