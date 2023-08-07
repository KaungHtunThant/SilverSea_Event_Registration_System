<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->searchVal != '') {
            $visitors =  Visitor::where('conf_id', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('name', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('phone', 'LIKE', '%'.$request->searchVal.'%')
            ->orderBy($request->orderBy)
            ->paginate($request->paginate);
        }
        else{
            $visitors = Visitor::orderBy($request->orderBy)->paginate($request->paginate);
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

    public function view_visitors(Request $request)
    {
        $visitors = Visitor::orderBy('conf_id')->paginate(10);

        return $visitors;
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'dob' => 'required|string',
            'sex' => 'required|string',
            'company' => 'string'
        ]);

        $lastid = Visitor::latest('id')->first();
        if ($lastid == Null) {
            $lastid = 0;
        }
        $dob = date('Y-m-d', strtotime($fields['dob']));

        $card = 'MME-VIS-'.$lastid->id+1001;

        if($fields['company']==''){
            $fields['company'] = 'None';
        }

        $user = Visitor::create([
            'conf_id' => $card,
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'dob' => $dob,
            'sex' => $fields['sex'],
            'company' => $fields['company'],
            'card' => $card,
        ]);

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);

        return redirect('/visitors')->with('status', [
                'type' => 'success',
                'text' => 'Visitor record created successfully!'
            ]);
    }

    public function form_add(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'dob' => 'required|string',
            'sex' => 'required|string',
            'company' => 'string'
        ]);

        $lastid = Visitor::latest('id')->first();
        if ($lastid == Null) {
            $lastid = 0;
        }
        $dob = date('Y-m-d', strtotime($fields['dob']));

        $card = 'MME-VIS-'.$lastid->id+1001;

        if($fields['company']==''){
            $fields['company'] = 'None';
        }

        $user = Visitor::create([
            'conf_id' => $card,
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'dob' => $dob,
            'sex' => $fields['sex'],
            'company' => $fields['company'],
            'card' => $card,
        ]);

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);

        return redirect('/form')->with('status', [
                'type' => 'success',
                'text' => 'Visitor record created successfully!'
            ]);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'dob' => 'required|string',
            'sex' => 'required|string',
            'company' => 'required|string'
        ]);

        $visitor = Visitor::find($id);

        if ($visitor == Null) {
            return redirect('/visitors')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record update failed! Visitor not found.'
            ]);
        }

        $visitor->update([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'dob' => date('Y-m-d', strtotime($fields['dob'])),
            'sex' => $fields['sex'],
            'company' => $fields['company'],
        ]);

        // $cmd = 'wkhtmltoimage --crop-h 1171 --crop-w 744 --crop-x 0 --crop-y 0 http://'.$this->domain.'/printables/employee/'.$row['card_id'].' employees/printables/'.$this->foldername.'/'.$row['card_id'].'.jpg';
        // exec($cmd);
        return redirect('/visitors')->with('status', [
            'type' => 'success',
            'text' => 'Visitor record updated successfully!'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if ($visitor == Null) {
            return redirect('/visitors')->with('status', [
                'type' => 'fail',
                'text' => 'Visitor record deletion failed! Visitor not found.'
            ]);
        }
        $visitor->delete();
        return redirect('/visitors')->with('status', [
            'type' => 'success',
            'text' => 'Visitor record deleted successfully!'
        ]);
    }
}