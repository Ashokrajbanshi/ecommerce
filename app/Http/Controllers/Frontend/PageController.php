<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends BaseController
{
    public function home()
    {
        return view('frontend.home');
    }

    public function clientRequest(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'shop_name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:clients',
            'address' => 'required',
            'terms' => 'required',
        ]);

        $client = new Client();
        $client->client_name = $request->client_name;
        $client->shop_name = $request->shop_name;
        $client->contact = $request->contact;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();

        Alert::toast('Your request has been sent successfully!', 'success');

        return redirect()->back();
    }
}
