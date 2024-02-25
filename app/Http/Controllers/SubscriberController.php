<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    // get data
    public function index(){
        $subscribers = Subscriber::all();
        return response()->json($subscribers, Response::HTTP_OK);
    }
}
