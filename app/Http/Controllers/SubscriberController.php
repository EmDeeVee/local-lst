<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    // // get data
    // public function index(){
    //     $subscribers = Subscriber::all();
    //     return response()->json($subscribers, Response::HTTP_OK);
    // }

    // post data
    public function store(Request $request){
        $validData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns',
            'gender' => 'required',
            'mailing_list_id' => 'required|integer|gte:0' 
        ]);

        $subscriber = new Subscriber([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'gender' => $validData['gender'],
            'mailing_list_id' => $validData['mailing_list_id']
        ]);

        $subscriber->save();

        return response()->json($subscriber, Response::HTTP_CREATED);
    }
    
}
