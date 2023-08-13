<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Http\Client;
use Knp\Snappy\Image;
// use GuzzleHttp;
// use Illuminate\View;

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

        return view('form.index')->with('status', [
                'type' => 'success',
                'text' => 'Registered successfully! Please inquiry at the counter to recieve your ID.'
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

    public function download_img(Request $request, $id)
    {
        // return SnappyPdf::loadFile('http://127.0.0.1:8000/visitors/download/'.$id)->inline('id_'.$id.'.pdf');
        // $snappy = App::make('snappy.pdf');
        // $snappy->generate('http://www.github.com', '/tmp/github.pdf');

        // This works
        // $snappy = new Image('/var/www/html/SilverSea_Event_Registration_System' . '/vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64');
        // $snappy->generateFromHtml('http://127.0.0.1:8000/visitors/download/'.$id, 'test_'.time().'.jpg');
        // $html = View::make('http://127.0.0.1:8000/visitors/download/'.$id)->render();
        // dd($html);
        $url = 'https://silversea.powerglobal.com.mm/visitors/download/'.$id;
        $resp = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        dd($data);

        // $response = $client->get('http://127.0.0.1:8000/visitors/download/'.$id);

        // You need to parse the response body
        // This will parse it into an array
        // $json = json_decode($response->getBody(), true);

        // $snappy = new Image('/var/www/html/SilverSea_Event_Registration_System' . '/vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64');
        // $snappy->generateFromHtml('<html><body><h1>Hello world</h1></body></html>', 'test_'.time().'.jpg');
        // // return $json;
    }
}