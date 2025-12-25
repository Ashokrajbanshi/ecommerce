<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ClientRequestNotification;
use App\Models\Admin;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends BaseController
{
    public function home()
    {
        return view('frontend.home');
    }

    public function clientRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:clients',
            'address' => 'required',
            'terms' => 'required',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->shop_name = $request->shop_name;
        $client->contact = $request->contact;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();
        $admin = Admin::first();
        Mail::to($admin)->send(new ClientRequestNotification($client));

        toast('Your request has been sent successfully!', 'success');

        return redirect()->back();
    }
}
