<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientDetail;
use App\Models\contactus;
use App\Models\subscribe;

class ClientController extends Controller
{

    // add subscribe
    public function AddSubscribe(Request $request)
    {
        subscribe::create([
            'email' => $request->email,
            'status' => 1
        ]);
        $status = 'true';
        return response()->json($status);
    }
    public function view_Subscribes()
    {
        $subscribes = subscribe::all();
        return view('admin.users.subscriber', compact('subscribes'));
    }
    public function viewClient()
    {
        $clients = clientDetail::all();
        return view('admin.users.index', compact('clients'));
    }
    public function viewContact()
    {
        $contacts = contactus::all();
        return view('admin.users.ViewContact', compact('contacts'));
    }
    public function store(Request $request)
    {
        $contactus = new contactus();
        $contactus->name = $request->name;
        $contactus->email = $request->email;
        $contactus->phoneNo = $request->phone_no;
        $contactus->webSite     = '';
        $contactus->message = $request->message;
        $contactus->save();
        return redirect()->back();
    }
    public function delete($id)
    {
        // dd($id);
        contactus::find($id)->delete();
        return redirect()->back();
    }
}
