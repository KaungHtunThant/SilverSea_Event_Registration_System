<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Image;
use App\Exports\VisitorsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;

class VisitorController extends Controller
{
    public function index(Request $request)
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

        if ($request->searchVal != '') {
            $visitors =  Visitor::where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('name', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('email', 'LIKE', '%'.$request->searchVal.'%')
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
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'sex' => 'required|string',
            'company' => 'nullable|string',
        ]);

        $lastid = Visitor::latest('id')->first();
        if ($lastid == Null) {
            $lastid = 0;
            $card = 'MME-VIS-'.$lastid+1001;
        }
        else{
            $card = 'MME-VIS-'.$lastid->id+1001;
        }

        if($fields['company'] == Null){
            $fields['company'] = '-';
        }
        if($fields['email'] == Null){
            $fields['email'] = '-';
        }

        $user = Visitor::create([
            'conf_id' => $card,
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'position' => $fields['position'],
            'sex' => $fields['sex'],
            'company' => $fields['company'],
            'card' => $card,
        ]);

        if (isset($request->pos)) {
            foreach ($request->pos as $pos) {
                $interest = Interest::create([
                    'vis_id' => $user->id,
                    'desc' => $pos
                ]);
            }
        }

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);

        return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'success',
                'text' => 'Visitor record created successfully!'
            ]);
    }

    public function form_add(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'sex' => 'required|string',
            'company' => 'nullable|string',
        ]);

        $lastid = Visitor::latest('id')->first();
        if ($lastid == Null) {
            $lastid = 0;
            $card = 'MME-VIS-'.$lastid+1001;
        }
        else{
            $card = 'MME-VIS-'.$lastid->id+1001;
        }

        if($fields['company'] == Null){
            $fields['company'] = '-';
        }
        if($fields['email'] == Null){
            $fields['email'] = '-';
        }

        $user = Visitor::create([
            'conf_id' => $card,
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'position' => $fields['position'],
            'sex' => $fields['sex'],
            'company' => $fields['company'],
            'card' => $card,
        ]);

        if (isset($request->pos)) {
            foreach ($request->pos as $pos) {
                $interest = Interest::create([
                    'vis_id' => $user->id,
                    'desc' => $pos
                ]);
            }
        }

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);

        Session::put('status', 'true');

        return view('admin.visitors.download')
            ->with('status', [
                'type' => 'success',
                'text' => 'Registered successfully! Please inquiry at the counter to recieve your ID.'
            ])
            ->with('visitor', $user);
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

        if($request->company == Null){
            $request->company = '-';
        }
        if($request->email == Null){
            $request->email = '-';
        }

        $input = $request->all();
        $visitor->fill($input)->save();

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);
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

    public function download(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if ($visitor == Null) {
            return redirect('/visitors?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record deletion failed! Visitor not found.'
            ]);
        }
        return view('admin.visitors.download')
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